<?php

namespace App\Repositories;

use App\Models\TrophyRank;

class TrophyRanks extends Repository
{
    public function __construct()
    {
        parent::__construct(new TrophyRank());
    }

}