<?php

namespace App\Repositories;

use App\Models\Announcement;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
/**
 * This class manage all function of Announcements
 * Class Announcements
 * @package App\Repositories
 */
class Announcements extends Repository
{
    public $action = 'announcements';

    /**
     * Announcements constructor.
     */
    public function __construct()
    {
        parent::__construct(new Announcement());
    }

    public function search(array $params)
    {
        // Set sort and paginate
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'asc';

        // Start search query
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['subject'])) {
            $this->query->where('subject', 'LIKE', '%' . $params['subject'] . '%');
        }

        // set older page before update action
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }

        // Set session search params
        Session::put('params', $params);

        return $this->query->paginate($perPage);
    }
    public function get($lang)
    {
         $result = DB::table('announcements')
            ->join('languages', 'languages.id', 'announcements.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'announcements.id as id',
                'announcements.subject AS subject',
                'announcements.description AS description',
                'announcements.updated_at AS date'
            )
            ->get();
        return $result;
    }

}