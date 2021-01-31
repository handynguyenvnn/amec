<?php

namespace App\Repositories;

use App\Models\Ad;
use App\Models\AdVideo;
use App\Models\LogActiveTime;
use App\Models\Version;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Apps extends Repository
{
    public $action = 'apps';
    public function __construct()
    {
        parent::__construct(new Ad());
    }

    /**
     * @param null $timeId
     * @param $complete_flag
     * @param $date
     * @param $userId
     * @return LogActiveTime|bool|mixed|static
     */
    public function postHistory( $timeId = null, $complete_flag, $date, $userId)
    {
        if($complete_flag == 0) {
            $logs_active_out_time = LogActiveTime::find($timeId);
            if (!count($logs_active_out_time) > 0) {
                return false;
            }
            $logs_active_out_time->end_time = urldecode($date);
            $logs_active_out_time->user_id = $userId;
            $logs_active_out_time->save();
            return $logs_active_out_time;
        }else {
            $logs_active_in_time = new LogActiveTime();
            $logs_active_in_time->start_time = urldecode($date);
            $logs_active_in_time->end_time = null;
            $logs_active_in_time->user_id = $userId;
            $logs_active_in_time->save();
            return $logs_active_in_time;
        }
    }

}