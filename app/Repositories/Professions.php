<?php

namespace App\Repositories;


use App\Models\Profession;

class Professions extends Repository
{

    /**
     * Professions constructor.
     */
    public function __construct()
    {
        parent::__construct(new Profession());
    }
}