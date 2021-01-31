<?php

namespace App\Libs\ApiValidators;

use Illuminate\Http\Request;
use Validator;
use DB;

class GradeValidator
{
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'input_date' => 'required|date_format:Y-m-d H:i:s',
            'grade_id' => 'required|int'
        ), array(
            'input_date.required' => 'You must to add params input_date',
            'input_date.date_format'=> 'Params input_date must to time Y-m-d H:i:s',
            'grade_id.required' => 'You must to add params grade_id',
            'grade_id.int' => 'The grade id must be an integer',
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }

    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequestInformation(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'date' => 'required|date_format:Y-m-d H:i:s',
            'first_time' => 'required|boolean'
        ), array(
            'date.required' => 'You must to add params date',
            'date.date_format'=> 'Params date must to time Y-m-d H:i:s',
            'first_time.required' => 'You must to add params first_time',
            'first_time.boolean' => 'The first_time must be an boolean',
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequestFirstTime(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'first_time' => 'required|boolean'
        ), array(
            'first_time.required' => 'You must to add params first_time',
            'first_time.boolean' => 'The first_time must be an boolean',
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public static function validateRequestState(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'state' => 'required|int'
        ), array(
            'state.required' => 'You must to add params state',
            'state.int' => 'The state must be an int',
        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
}