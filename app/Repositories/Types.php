<?php

namespace App\Repositories;


use App\Models\Type;

class Types extends Repository
{
    /**
     * Types constructor.
     */
    public function __construct()
    {
        parent::__construct(new Type());
    }
}