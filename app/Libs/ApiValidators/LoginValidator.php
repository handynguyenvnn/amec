<?php

namespace App\Libs\ApiValidators;

use Illuminate\Http\Request;
use Validator;
use DB;

class LoginValidator
{
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'mobile_platform' => 'required|int',
            'language_id' => 'required|int'
        ), array(
            'mobile_platform.required' => 'You must to add params mobile_platform',
            'mobile_platform.int'=> 'mobile_platform model must be an integer',
            'language_id.required' => 'You must to add params language_id',
            'language_id.int'=> 'language_id  must be an integer'
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
}