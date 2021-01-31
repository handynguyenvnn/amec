<?php

namespace App\Repositories;

use App\Models\Maker as _Makers;
use App\Models\Collection as _Collections;

class Makers extends Repository
{
    /**
     * Makers constructor.
     */
    public function __construct()
    {
        parent::__construct(new _Makers());
    }

    /**
     * search keyword
     *
     * @param $keyword
     */
    public function search($keyword)
    {
        return $this->query->where('name', 'like', '%'.$keyword.'%')
            ->get();
    }

    /**
     * Check Maker Use?
     */
    public function checkID($id)
    {
        return _Collections::where("maker_id",$id)->get()->count();
    }
}