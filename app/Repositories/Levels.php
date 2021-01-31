<?php

namespace App\Repositories;

use App\Models\Level;
use Illuminate\Support\Facades\DB;

class Levels extends Repository
{
    /**
     * Levels constructor.
     */
    public function __construct()
    {
        parent::__construct(new Level());
    }
    public function getFirstFourValues(){
        return DB::table('levels')->limit(4)->get();
    }
}