<?php

namespace App\Http\Controllers\API;

use App\Repositories\SmallTests;
use Illuminate\Http\Request;
use App\Libs\ApiValidators\SmallTestValidator;
use JWTAuth;
use Hash;

/**
 * Class SmallTestController
 * @package App\Http\Controllers\API
 */

class SmallTestController extends ApiController
{
    public function get( $lang, SmallTests $smallTests){
        if(!$smallTests->fetchALlAPI($lang)) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Small Test download success', $smallTests->fetchALlAPI($lang));

    }
    public function post( Request $request, SmallTests $smallTests){
        $validate = SmallTestValidator::validateRequest($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        $userId = JWTAuth::parseToken()->authenticate()->id;
        $results = $smallTests->postHistory($request->id, $request->point, $userId);
        if(!$results) {
            return $this->result(false, 'Not post data');
        }
        return $this->result(true, 'help', $results);

    }
    public function listAll( $chapterId, SmallTests $smallTests){
        if(!$smallTests->listAll($chapterId)) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Small Test list all', $smallTests->listAll($chapterId));

    }

}
