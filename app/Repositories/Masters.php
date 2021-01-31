<?php

namespace App\Repositories;

use App\Models\Language;
use Illuminate\Support\Facades\Session;

class Masters extends Repository
{
    public $action = 'master';
    /**
     * Masters constructor.
     */
    public function __construct()
    {
        parent::__construct(new Language());
    }

    /**
     * search keyword
     *
     * @param $params
     */
    public function search(array $params)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'asc';
        if (isset($params['lang'])) {
            $this->query->where('lang', 'LIKE', '%' . $params['lang'] . '%');
        }
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    /**
     * Check Maker Use?
     */
    public function checkID($id)
    {
        return _Collections::where("maker_id",$id)->get()->count();
    }
}