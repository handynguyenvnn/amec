<?php

namespace App\Repositories;


use App\Models\SmallTestQuestionChoice;

class SmallTestQuestionChoices extends Repository
{
    /**
     * SmallTestQuestionChoices constructor.
     */
    public function __construct()
    {
        parent::__construct(new SmallTestQuestionChoice());
    }
}