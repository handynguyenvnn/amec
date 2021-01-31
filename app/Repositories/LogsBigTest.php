<?php

namespace App\Repositories;


use App\Models\LogBigTest;

class LogsBigTest extends Repository
{

    /**
     * LogsBigTest constructor.
     */
    public function __construct()
    {
        parent::__construct(new LogBigTest());
    }
}