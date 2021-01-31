<?php

namespace App\Repositories;

use App\Models\Area;

class Areas extends Repository
{
    /**
     * Areas constructor.
     */
    public function __construct()
    {
        parent::__construct(new Area());
    }
}