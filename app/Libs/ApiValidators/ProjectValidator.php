<?php

namespace App\Libs\ApiValidators;

use Illuminate\Http\Request;
use Validator;
use DB;

class ProjectValidator
{
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'input_date' => 'required|date_format:Y-m-d H:i:s'
        ), array(
            'input_date.required' => 'You must to add params input_date',
            'input_date.date_format'=> 'Params input_date must to time Y-m-d H:i:s'

        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
}