<?php

namespace App\Libs\ApiValidators;

use Illuminate\Http\Request;
use Validator;
use DB;

class AppValidator
{
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'date' => 'required|date_format:Y-m-d H:i:s',
            'complete_flag' => 'required|boolean',
            'time_id' => 'required|int'

        ), array(
            'date.required' => 'You must to add params date',
            'date.date_format'=> 'params date must to time Y-m-d H:i:s',
            'complete_flag.required' => 'You must to add params complete_flag',
            'complete_flag.boolean'=> 'params complete_flag must to boolean',
            'time_id.required' => 'You must to add params time_id',
            'time_id.int'=> 'params time_id must to int'
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
}