<?php

namespace App\Libs\ApiValidators;

use Illuminate\Http\Request;
use Validator;
use DB;

class CertificateValidator
{
    /**
     * @param Request $request
     * @return string
     */
    public static function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'certificate_id' => 'required|int|unique:possession_certificates,certificate_id|unique:possession_certificates,user_id',
            'issue_date' => 'required|date_format:Y-m-d H:i:s',
            'photo_path' => 'required|string'

        ), array(
            'certificate_id.unique' => 'You passed this',
            'certificate_id.required' => 'You must to add params certificate_id',
            'certificate_id.int'=> 'params collection_id must be an integer',
            'photo_path.required' => 'You must to add params photo_path',
            'photo_path.tring' => 'params photo_path must to string',
            'issue_date.required' => 'You must to add params issue_date',
            'issue_date.date_format' => 'params issue_date must to time Y-m-d H:i:s',

        ));
        if ($validator->fails()) {
            return $validator->messages();
        }
        return false;
    }
    public static function validateRequestBackground(Request $request)
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