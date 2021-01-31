<?php

namespace App\Http\Controllers\API;

use App\Repositories\Trophies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * This class manage all function of trophy
 * Class TrophyController
 * @package App\Http\Controllers\API
 */
class TrophyController extends ApiController
{
    /**
     * This function get all Trophy
     * @param $lang
     * @param Trophies $trophies
     * @return array
     */
    public function getTrophy($lang, $grade_id, Trophies $trophies)
    {
        $res = $trophies->getTrophy($lang, $grade_id);
        if (!$res) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Trophy download success', $res);
    }

    /**
     * This function get all Part
     * @param $lang
     * @param Trophies $trophies
     * @return array
     */
    public function getPart($lang, Trophies $trophies)
    {
        $res = $trophies->getPart($lang);
        if (!$res) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Trophy download success', $res);
    }

    /**
     * This function get all Card
     * @param $lang
     * @param Trophies $trophies
     * @return array
     */
    public function getCard($lang, Trophies $trophies)
    {
        $res = $trophies->getCard($lang);
        if (!$res) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Trophy download success', $res);
    }

    /**
     * This function get all Complete
     * @param $lang
     * @param Trophies $trophies
     * @return array
     */
    public function getComplete($lang, Trophies $trophies)
    {
        $res = $trophies->getComplete($lang);
        if (!$res) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Trophy download success', $res);
    }

}
