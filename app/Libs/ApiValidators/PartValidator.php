<?php

namespace App\Libs\ApiValidators;

use Illuminate\Http\Request;
use Validator;
use DB;

class PartValidator
{
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'collection_id' => 'required|int|unique:possession_collections,collection_id|unique:possession_collections,user_id',
            'pass' => 'required|boolean'
        ), array(
            'collection_id.unique' => 'You passed this',
            'collection_id.required' => 'You must to add params collection_id',
            'collection_id.int'=> 'params collection_id must be an integer',
            'pass.required' => 'You must to add params pass',
            'pass.boolean' => 'params pass must to have value is boolean: 1 or 0'

        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
}