<?php

namespace App\Repositories;


use App\Models\LogLogin;

class LogsLogin extends Repository
{
    /**
     * LogsLogin constructor.
     */
    public function __construct()
    {
        parent::__construct(new LogLogin());
    }
}