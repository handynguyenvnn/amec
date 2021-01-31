<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Http\Requests\API\UserRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Repositories\Users;
use JWTAuth;
use Hash;
use App\Libs\ApiValidators\UserValidator;

class ApiController extends Controller
{
    public function __construct()
    {
    }

    protected function result($status, $message = '', $data = null, $statusCode = ResCodes::OK)
    {
        $result = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'status_code' => $statusCode
        ];
        return $result;
    }

    protected function isValidRequest(Request $request, array $rules)
    {
        $validator = Validator::make($request->all(), $rules);
        return !$validator->fails();
        /*
        if ($validator->fails()) {
            return $validator->errors();
        }
        return [];
        */
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
        return $user;
    }

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
        $credentials = $request->only('email', 'password', 'device_id');
        $user = $users->getUserByCredentials($credentials);
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

        // all good so return the token
        return $this->result(true, 'login_success', compact('token'));
    }
}
