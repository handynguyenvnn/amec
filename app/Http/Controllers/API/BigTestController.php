<?php

namespace App\Http\Controllers\API;

use App\Repositories\BigTests;
use Illuminate\Http\Request;
use App\Libs\ApiValidators\BigTestValidator;
use JWTAuth;
use Hash;

/**
 * Class SmallTestController
 * @package App\Http\Controllers\API
 */

class BigTestController extends ApiController
{
    public function post( Request $request, BigTests $bigTests){
        $validate = BigTestValidator::validateRequest($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        $userId = JWTAuth::parseToken()->authenticate()->id;
        $results = $bigTests->postHistory($request->id, $request->point, $userId);
        if(!$results) {
            return $this->result(false, 'Not post data');
        }
        return $this->result(true, 'post success', $results);

    }
}
