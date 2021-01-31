<?php

namespace App\Http\Controllers\API;

use App\Repositories\Languages;
use Illuminate\Http\Request;
use App\Libs\ApiValidators\LanguageValidator;
use JWTAuth;
use Hash;

class LanguageController extends ApiController
{
    /**
     * Get all languages show to screen
     * @return array
     */
    public function getAll(Languages $languages)
    {
        $languages = $languages->getLang();
        if (!$languages) {
            return $this->result(false, 'get empty data from server', null, 204);
        }
        return $this->result(true, 'get data successfully', $languages, 200);
    }
    public function postLang( Request $request, Languages $languages){
        $validate = LanguageValidator::validateRequest($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        $userId = JWTAuth::parseToken()->authenticate()->id;
        $results = $languages->postLang($request->language_id, $userId);
        if(!$results) {
            return $this->result(false, 'Not post data');
        }
        return $this->result(true, 'post lang success', $results);
    }
}