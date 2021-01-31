<?php

namespace App\Repositories;


use App\Models\LogActiveTime;

class LogsActiveTime extends Repository
{

    /**
     * LogsActiveTime constructor.
     */
    public function __construct()
    {
        parent::__construct(new LogActiveTime());
    }
}