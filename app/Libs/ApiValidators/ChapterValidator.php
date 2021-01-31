<?php

namespace App\Libs\ApiValidators;

use Illuminate\Http\Request;
use Validator;
use DB;

class ChapterValidator
{
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'completion_flg' => 'required|boolean',
            'id' => 'required|int'

        ), array(
            'completion_flg.required' => 'You must to add params completion_flg',
            'completion_flg.boolean'=> 'params completion_flg must be an boolean',
            'id.required' => 'You must to add params id',
            'id.int'=> 'params id must be an integer'
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
}