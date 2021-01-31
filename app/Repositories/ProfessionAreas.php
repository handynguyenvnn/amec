<?php

namespace App\Repositories;


use App\Models\Area;
use App\Models\Profession;
use Illuminate\Support\Facades\DB;

class ProfessionAreas extends Repository
{

    /**
     * Projects constructor.
     */
    public function __construct()
    {
        parent::__construct(new Profession());
    }
    public function get($lang){
            $result['areas'] = DB::table('areas')
                ->join('languages', 'languages.id', 'areas.language_id')
                ->where('languages.lang_code', $lang)
                ->select(
                    'areas.id as id',
                    'areas.area AS name'
                )
                ->get();
        $result['professions'] = DB::table('professions')
            ->join('languages', 'languages.id', 'professions.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'professions.id as id',
                'professions.profession AS name'
            )
            ->get();
            return $result;
    }
}