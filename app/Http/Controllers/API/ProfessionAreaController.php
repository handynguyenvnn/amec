<?php

namespace App\Http\Controllers\API;

use App\Repositories\ProfessionAreas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * This class manage function of Advertisements
 * Class AdvertisementController
 * @package App\Http\Controllers\API
 */
class ProfessionAreaController extends ApiController
{
    /**
     * This function get all Advertisements
     * @param ProfessionAreas $professionAreas
     * @param $lang
     * @return array
     */
    public function getAll( ProfessionAreas $professionAreas, $lang){
        $res = $professionAreas->get($lang);
        if(!$res) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'ProfessionAreas download success', $res);

    }
}
