<?php

namespace App\Libs\ApiValidators;

use Illuminate\Http\Request;
use Validator;
use DB;

class BigTestValidator
{
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'point' => 'required|int',
            'id' => 'required|int'

        ), array(
            'point.required' => 'You must to add params point',
            'point.int'=> 'params point must be an integer',
            'id.required' => 'You must to add params id',
            'id.int'=> 'params id must be an integer'
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
}