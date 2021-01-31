<?php

namespace App\Http\Controllers\API;

use App\Repositories\Terms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * This class manage all function of terms
 * Class TermController
 * @package App\Http\Controllers\API
 */
class TermController extends ApiController
{
    /**
     *  This function get Terms
     *
     * @param $lang
     * @param Terms $terms
     * @return array
     */
    public function getTerms( $lang, Terms $terms){
        if(!$terms->getTerms($lang)) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Terms download success', $terms->getTerms($lang));

    }
}
