<?php

namespace App\Repositories;


use App\Models\GradeName;

class GradeNames extends Repository
{
    /**
     * GradeNames constructor.
     */
    public function __construct()
    {
        parent::__construct(new GradeName());
    }
}