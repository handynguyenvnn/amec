<?php

namespace App\Repositories;


use App\Models\Tag;
use App\Models\Collection as _Collections;

class Tags extends Repository
{
    /**
     * Tags constructor.
     */
    public function __construct()
    {
        parent::__construct(new Tag());
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
     * Check Tag Use?
     */
    public function checkID($id)
    {
        return _Collections::where("tag_id",$id)->get()->count();
    }
}