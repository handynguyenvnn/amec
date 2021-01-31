<?php

namespace App\Repositories;


use App\Models\LogSmallTest;

class LogsSmallTest extends Repository
{
    /**
     * LogsSmallTest constructor.
     */
    public function __construct()
    {
        parent::__construct(new LogSmallTest());
    }
}