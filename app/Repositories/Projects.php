<?php

namespace App\Repositories;


use App\Models\Project;

class Projects extends Repository
{

    /**
     * Projects constructor.
     */
    public function __construct()
    {
        parent::__construct(new Project());
    }
}