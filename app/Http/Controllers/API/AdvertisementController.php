<?php

namespace App\Http\Controllers\API;

use App\Repositories\Advertisements;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * This class manage function of Advertisements
 * Class AdvertisementController
 * @package App\Http\Controllers\API
 */
class AdvertisementController extends ApiController
{
    /**
     * This function get all Advertisements
     * @param Advertisements $advertisements
     * @return array
     */
    public function getAds( Advertisements $advertisements){
        $res = $advertisements->getAds();
        if(!$res) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Advertisements download success', $res);

    }
}
