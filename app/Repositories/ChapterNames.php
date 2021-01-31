<?php

namespace App\Repositories;


use App\Models\ChapterName;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class ChapterNames extends Repository
{
    public function __construct()
    {
        parent::__construct(new ChapterName());
    }
    public $action = 'report_access';

    public function search(array $params)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['name'])) {
            $this->query->where('name', 'LIKE', '%' . $params['name'] . '%');
        }
        if (isset($params['language_id'])) {
            $this->query->where('language_id', $params['language_id']);
        }
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }
    public function destroyByChapterId($chapterId){
        $chapterName = ChapterName::where('chapter_id',$chapterId);
        $chapterName->delete();
    }

}