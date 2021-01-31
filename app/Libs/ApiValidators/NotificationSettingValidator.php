<?php

namespace App\Libs\ApiValidators;

use Illuminate\Http\Request;
use Validator;
use DB;

class NotificationSettingValidator
{
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'firebase_token' => 'required|string',

        ), array(
            'state.required' => 'You must to add params state',
            'state.string' => 'state must to a string',
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
}