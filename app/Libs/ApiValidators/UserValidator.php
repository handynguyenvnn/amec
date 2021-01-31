<?php

namespace App\Libs\ApiValidators;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use DB;

class UserValidator
{
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequest(Request $request, $id = '')
    {
        if ($id) {
            $email = User::find($id)->email;
            if($request->get('email')== $email){
                $validator = Validator::make($request->all(), array(
                    'email' => 'required|max:256|email',
                    'password' => 'required',
                    'mobile_platform' => 'required|boolean',
                    'username' => 'required|max:64',
                    'gender' => 'required',
                    'area' => 'required',
                    'profession' => 'required',
                    'language_id' => 'required',
                    'address' => 'max:256'
                ), array(
                    'email.required' => 'You must to add params email',
                    'email.email' => 'Email is incorrect',
                    'email.max' => 'Email only have 256 character',
                    'password.required' => 'You must to add params password',
                    'mobile_platform.required' => 'You must to add params mobile_platform',
                    'mobile_platform.boolean' => 'mobile_platform is boolean',
                    'username.required' => 'You must to add params username',
                    'username.max' => 'username only have 64 character',
                    'gender.required' => 'You must to add params gender',
                    'area.required' => 'You must to add params area',
                    'profession.required' => 'You must to add params profession',
                    'language_id.required' => 'You must to add params language_id',
                    'address.max' => 'address only have 256 character'
                ));
            }else{
                $validator = Validator::make($request->all(), array(
                    'email' => 'required|max:256|email|unique:users,email',
                    'password' => 'required',
                    'mobile_platform' => 'required|boolean',
                    'username' => 'required|max:64',
                    'gender' => 'required',
                    'area' => 'required',
                    'profession' => 'required',
                    'language_id' => 'required',
                    'address' => 'max:256'
                ), array(
                    'email.required' => 'You must to add params email',
                    'email.email' => 'Email is incorrect',
                    'email.max' => 'Email only have 256 character',
                    'email.unique' => 'This Email existed',
                    'password.required' => 'You must to add params password',
                    'mobile_platform.required' => 'You must to add params mobile_platform',
                    'mobile_platform.boolean' => 'mobile_platform is boolean',
                    'username.required' => 'You must to add params username',
                    'username.max' => 'username only have 64 character',
                    'gender.required' => 'You must to add params gender',
                    'area.required' => 'You must to add params area',
                    'profession.required' => 'You must to add params profession',
                    'language_id.required' => 'You must to add params language_id',
                    'address.max' => 'address only have 256 character'
                ));
            }

        }else {
            $validator = Validator::make($request->all(), array(
                'email' => 'required|max:256|email|unique:users,email',
                'password' => 'required',
                'mobile_platform' => 'required|boolean',
                'username' => 'required|max:64',
                'gender' => 'required',
                'area' => 'required',
                'profession' => 'required',
                'language_id' => 'required',
                'address' => 'max:256'
            ), array(
                'email.required' => 'You must to add params email',
                'email.email' => 'Email is incorrect',
                'email.max' => 'Email only have 256 character',
                'email.unique' => 'This Email existed',
                'password.required' => 'You must to add params password',
                'mobile_platform.required' => 'You must to add params mobile_platform',
                'mobile_platform.boolean' => 'mobile_platform is boolean',
                'username.required' => 'You must to add params username',
                'username.max' => 'username only have 64 character',
                'gender.required' => 'You must to add params gender',
                'area.required' => 'You must to add params area',
                'profession.required' => 'You must to add params profession',
                'language_id.required' => 'You must to add params language_id',
                'address.max' => 'address only have 256 character'
            ));
        }
        if ($validator->fails()) {
            return $validator->messages();
        }
        return '';
    }

    public static function validateRequestIOS(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'ios_token' => 'required|max:256'
        ), array(
            'ios_token.required' => 'You must to add params ios_token',
            'ios_token.max' => 'ios_token only have 256 character',
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
    public static function validateRequestPhoto(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'user_photo' => 'required|file'
        ), array(
            'user_photo.required' => 'You must to add params user_photo',
            'user_photo.file' => 'user_photo must to is file',
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
    public static function validateRequestANDROID(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'firebase_token' => 'required|max:256'
        ), array(
            'firebase_token.required' => 'You must to add params firebase_token',
            'firebase_token.max' => 'firebase_token only have 256 character',
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
    /**
     * @param $email
     * @return bool
     */
    private static function isUniqueEmail($email)
    {
        $user = DB::table('users')->where('email', $email)->first();
        return $user ? false : true;
    }
}