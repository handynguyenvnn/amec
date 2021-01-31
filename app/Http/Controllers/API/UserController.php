<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\UserRequest;
use App\Libs\ApiValidators\LoginValidator;
use App\Libs\Constants\Constant;
use App\Models\Area;
use App\Models\Grade;
use App\Models\PossessionCertificate;
use App\Models\LogLogin;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Repositories\Users;
use JWTAuth;
use Hash;
use App\Libs\ApiValidators\UserValidator;
use Illuminate\Support\Facades\DB;

class UserController extends ApiController
{


    /**
     * Creating a Token based on the users credentials
     *
     * @param Request $request
     * @param Users $users
     * @return array
     */
    public function authenticate(Request $request, Users $users)
    {
        // grasp credentials from the request
        //$credentials = $request->only('email', 'password', 'device_id');
//        $credentials = $request->only('email', 'password');
        $validate = LoginValidator::validateRequest($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        if($request->mobile_platform == Constant::IOS_MOBILE_PLATFORM ){
            $msg_ios = UserValidator::validateRequestIOS($request);
            if ($msg_ios) {
                return $this->result(false, $msg_ios, null);
            }
        }
        if($request->mobile_platform == Constant::ANDROID_MOBILE_PLATFORM ){
            $msg_android = UserValidator::validateRequestANDROID($request);
            if ($msg_android) {
                return $this->result(false, $msg_android, null);
            }
        }
        $credentials = $request->only('email');
        $language_id = $request->language_id;
        $user = $users->getUserByCredentials($credentials, $language_id);
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$user || !$token = JWTAuth::fromUser($user)) {
                return $this->result(false, 'invalid_credentials', null, ResCodes::UNAUTHORIZED);
            }
        } catch (JWTException $exception) {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->result(false, 'invalid_credentials', null, ResCodes::UNAUTHORIZED);
            }
        }
        $user= User::where('email',$request->email)->first();

        if(count($user)>0){
            $userId = $user->id;
            $user->language_id = $language_id;
            if(isset($request['firebase_token'])) {
                $user->firebase_token = $request['firebase_token'];
            }
            if(isset($request['ios_token'])) {
                $user->ios_token = $request['ios_token'];
            }
            $user->save();
            $timeLogin = LogLogin::where('user_id', $userId)->whereDate('login_date', DB::raw('CURDATE()'))->get();
            $first_time = count($timeLogin)>0 ? false : true;
            $logLogin = new LogLogin();
            $logLogin->user_id = $userId;
            $logLogin->login_date = date('Y-m-d h:i:s');
            $logLogin->mobile_platform = $request->mobile_platform;
            $logLogin->save();
        }
        $users->updateFireBaseToken($user->id, $request->get('firebase_token'));
        // all good so return the token
        return $this->result(true, 'login_success', compact('token','first_time'));
    }

    /**
     * Retrieving the Authenticated user from a token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return $this->result(false, 'user_not_found');
            }
        } catch (TokenExpiredException $e) {
            return $this->result(false, 'token_expired');
        } catch (TokenInvalidException $e) {
            return $this->result(false, 'token_invalid');
        } catch (JWTException $e) {
            return $this->result(false, 'token_absent');
        }

        // the token is valid and we have found the user via the sub claim
        return $this->result(true, 'success', compact('user'));
    }

    /**
     * Register a user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request, Users $users)
    {
        $msg = UserValidator::validateRequest($request);
        if ($msg) {
            return $this->result(false, $msg, null, ResCodes::EMAIL_EXIST);
        }
        if($request->mobile_platform == Constant::IOS_MOBILE_PLATFORM ){
            $msg_ios = UserValidator::validateRequestIOS($request);
            if ($msg_ios) {
                return $this->result(false, $msg_ios, null);
            }
        }
        if($request->mobile_platform == Constant::ANDROID_MOBILE_PLATFORM ){
            $msg_android = UserValidator::validateRequestANDROID($request);
            if ($msg_android) {
                return $this->result(false, $msg_android, null);
            }
        }
        $input = $request->all();
        $user = new User();
        $user->email = $input['email'];
        $user->password = password_hash($input['password'], PASSWORD_BCRYPT);
        $user->registration_date = date('Y-m-d h:i:s');
        $user->username = $input['username'];
        $user->gender = $input['gender'];
        $area = Area::where('area',$input['area'])->first();
        $user->area_id = (count($area)>0) ? $area->id : 0;
        $profession = Profession::where('profession',$input['profession'])->first();
        $user->profession_id = (count($profession)>0) ? $profession->id : 0;
        $user->language_id = $input['language_id'];
        $user->firebase_token = isset($input['firebase_token']) ? $input['firebase_token'] : '';
        $user->ios_token = isset($input['ios_token']) ? $input['ios_token'] : '';
        $user->save();
        $logLogin = new LogLogin();
        $logLogin->user_id = $user->id;
        $logLogin->login_date = date('Y-m-d h:i:s');
        $logLogin->mobile_platform = $request->mobile_platform;
        $logLogin->save();
        $token = JWTAuth::fromUser($user);
        return $this->result(true, 'register_success', compact('token'), ResCodes::CREATED);
    }

    /**
     * Update user information
     * @param Request $request
     * @param Users $users
     * @return array
     */
    public function update(Request $request, Users $users)
    {
        $id = JWTAuth::parseToken()->authenticate()->id;
        $input = $request->except(['token']);
        $input['password'] = password_hash($input['password'], PASSWORD_BCRYPT);
        $msg = UserValidator::validateRequest($request, $id);
        if ($msg) {
            return $this->result(false, $msg, null, ResCodes::PRECONDITION_FAILED);
        }else{
            $user = User::find($id);
            $user->email = $input['email'];
            $user->phone = $input['phone'];
            $user->password = password_hash($input['password'], PASSWORD_BCRYPT);
            $user->registration_date = date('Y-m-d h:i:s');
            $user->username = $input['username'];
            $user->gender = $input['gender'];
            $area = Area::where('area',$input['area'])->first();
            $user->area_id = (count($area)>0) ? $area->id : 0;
            $profession = Profession::where('profession',$input['profession'])->first();
            $user->profession_id = (count($profession)>0) ? $profession->id : 0;
            $user->language_id = $input['language_id'];
            $user->firebase_token = isset($input['firebase_token']) ? $input['firebase_token'] : '';
            $user->ios_token = isset($input['ios_token']) ? $input['ios_token'] : '';
            $user->save();
            return $this->result(true, 'update_success', null, ResCodes::OK);
        }
    }

    /**
     * @param Users $users
     * @return \Illuminate\Http\JsonResponse
     */
    public function info( Users $users)
    {
        $userId = JWTAuth::parseToken()->authenticate()->id;
        $userInfo = $users->getById($userId);
        $possession_certificates = PossessionCertificate::where('user_id', $userId)->get();
        $arr_possession_certificates = [];
        if(count($possession_certificates)>0) {
            foreach ($possession_certificates as $key => $possession_certificate) {
                $arr_possession_certificates[$key]['id'] = $possession_certificate->id;
                $arr_possession_certificates[$key]['date'] = date( 'Y-m-d H:i:s', strtotime($possession_certificate->updated_at));
            }
        }
        $userInfo->possession_certificates = $arr_possession_certificates;
        $userInfo->area = Area::find($userInfo->area_id)->area;
        $userInfo->profession = Profession::find($userInfo->profession_id)->profession;
        return $this->result(true, 'user infor', $userInfo, ResCodes::OK);;
    }

    /**
     * Get user photo
     *
     * @param Users $users
     * @return array
     */
    public function photo(Users $users, Request $request)
    {
        $id = JWTAuth::parseToken()->authenticate()->id;
        $msg = UserValidator::validateRequestPhoto($request);
        if ($msg) {
            return $this->result(false, $msg, null, ResCodes::PRECONDITION_FAILED);
        }else {
            $user = $users->uploadPhoto($id, $request);
            return $this->result(true, 'S3Upload photo successful', $user, ResCodes::CREATED);
            }
        }
}
