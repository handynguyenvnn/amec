<?php

namespace App\Http\Controllers\API;

use App\Models\Guide;
use App\Repositories\Guides;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * This class manage all function of terms
 * Class TermController
 * @package App\Http\Controllers\API
 */
class GuideController extends ApiController
{
    /**
     *  This function get Terms
     *
     * @param $lang
     * @param Guides $guides
     * @return array
     */
    public function getGuides( $lang, Guides $guides){
        if(!$guides->getGuides($lang)) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Guides download success', $guides->getGuides($lang));

    }
}
