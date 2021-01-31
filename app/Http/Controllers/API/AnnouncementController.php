<?php

namespace App\Http\Controllers\API;

use App\Repositories\Advertisements;
use App\Repositories\Announcements;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * This class manage function of AnnouncementController
 * Class AdvertisementController
 * @package App\Http\Controllers\API
 */
class AnnouncementController extends ApiController
{
    /**
     * @param Announcements $announcements
     * @return array
     */
    public function get( $lang, Announcements $announcements){
        $res = $announcements->get($lang);
        if(!$res) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Announcements download success', $res);

    }
}
