<?php

namespace App\Repositories;


use App\Models\LogTips;

class LogsTips extends Repository
{

    /**
     * LogsTips constructor.
     */
    public function __construct()
    {
        parent::__construct(new LogTips());
    }
}