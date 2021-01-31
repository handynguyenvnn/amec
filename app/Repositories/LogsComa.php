<?php

namespace App\Repositories;


use App\Models\LogComa;

class LogsComa extends Repository
{
    /**
     * LogsComa constructor.
     */
    public function __construct()
    {
        parent::__construct(new LogComa());
    }
}