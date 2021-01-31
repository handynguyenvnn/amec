<?php

namespace App\Http\Controllers\API;

use App\Repositories\Apps;
use App\Repositories\BigTests;
use Illuminate\Http\Request;
use App\Libs\ApiValidators\AppValidator;
use JWTAuth;
use Hash;

/**
 * Class SmallTestController
 * @package App\Http\Controllers\API
 */

class AppController extends ApiController
{
    public function post( Request $request, Apps $apps){
        $validate = AppValidator::validateRequest($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        $userId = JWTAuth::parseToken()->authenticate()->id;
        $results = $apps->postHistory( $request->time_id, $request->complete_flag,$request->date, $userId);
        if(!$results) {
            return $this->result(false, 'Not post data');
        }
        return $this->result(true, 'post success', $results);

    }
}
