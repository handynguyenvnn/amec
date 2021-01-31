<?php

namespace App\Libs\ApiValidators;

use Illuminate\Http\Request;
use Validator;
use DB;

class CollectionValidator
{
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'type_id' => 'required|int',
            'grade_id' => 'required|int'
        ), array(
            'type_id.required' => 'You must to add params type_id',
            'type_id.int' => 'params type_id must be an integer',
            'grade_id.required' => 'You must to add params grade_id',
            'grade_id.int' => 'params grade_id must be an integer'
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
}