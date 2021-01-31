<?php

namespace App\Repositories;


use App\Models\SmallTestQuestionProblem;

class SmallTestQuestionProblems extends Repository
{
    /**
     * SmallTestQuestionProblems constructor.
     */
    public function __construct()
    {
        parent::__construct(new SmallTestQuestionProblem());
    }
}