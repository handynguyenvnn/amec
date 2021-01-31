<?php

namespace App\Libs\ApiCheckDate;

use Illuminate\Http\Request;

class CheckDate
{
    /**
     * This function compare two times
     * @param $timeFirst
     * @param $timeSecond
     * @return bool
     */
    public static function compareTwoTimes($timeFirst, $timeSecond)
    {
        return ($timeFirst < $timeSecond) ? true : false;
    }
}