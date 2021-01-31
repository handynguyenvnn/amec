<?php

namespace App\Libs\ApiValidators;

use Illuminate\Http\Request;
use Validator;
use DB;

class ComaCategoryValidator
{
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'language_id' => 'required|int'
        ), array(
            'language_id.required' => 'You must to add params language_id',
            'language_id.int'=> 'params language_id must be an integer'
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
}