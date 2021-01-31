<?php

namespace App\Repositories;


use App\Models\Authority;

class Authorities extends Repository
{
    /**
     * Authorities constructor.
     */
    public function __construct()
    {
        parent::__construct(new Authority());
    }
}