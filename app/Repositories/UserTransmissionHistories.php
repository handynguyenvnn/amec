<?php

namespace App\Repositories;

use App\Models\UserTransmissionHistory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\LogSmallTest;

class UserTransmissionHistories extends Repository
{
    /**
     * UserTransmissionHistories constructor.
     */
    public function __construct()
    {
        parent::__construct(new LogSmallTest());
    }
    public $action = 'user_transmission_histories';

    public function filterChapters($uid, array $params) {
        $params['action'] = '';
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';

        $this->query = DB::table('logs_small_test')
            ->join('versions', 'versions.relate_version', 'logs_small_test.relate_version')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->join('grade_names','grade_names.grade_id', 'versions.grade_id' )
            ->join('small_tests', function($join)
            {
                $join->on('small_tests.id', '=', 'logs_small_test.small_test_id');
                $join->on('small_tests.chapter_id', '=', 'chapters.id');
            })
            ->where('logs_small_test.user_id', $uid)
            ->where('grade_names.language_id', 1)
            ->where('chapter_names.language_id', 1)
            ->select(
                'logs_small_test.id AS logs_small_test_id',
                'chapter_names.id AS id',
                'grade_names.name AS grade_name',
                'chapter_names.name AS chapter_name',
                'chapters.updated_at AS updated_at',
                'logs_small_test.point AS pass_score_rate'
            );
        if (isset($params['name'])) {
            $this->query->where('chapter_names.name', 'LIKE', '%' . $params['name'] . '%');
        }
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }
    public function filterBigtests ($uid, array $params)
    {
        $params['action'] = '';
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'logs_big_test.id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';

        $this->query = DB::table('logs_big_test')
            ->join('versions', 'versions.relate_version', 'logs_big_test.relate_version')
            ->join('grade_names','grade_names.grade_id', 'versions.grade_id' )
            ->join('big_tests', function($join)
            {
                $join->on('big_tests.id', '=', 'logs_big_test.big_test_id');
                $join->on('big_tests.grade_id', '=', 'grade_names.grade_id');
            })
            ->where('logs_big_test.user_id', $uid)
            ->where('grade_names.language_id', 1)
            ->select(
                'logs_big_test.id',
                'grade_names.name AS grade_name',
                'logs_big_test.point',
                'logs_big_test.updated_at AS updated_at'
            )
            ->groupby(['logs_big_test.id',  'grade_names.name', 'logs_big_test.point', 'logs_big_test.updated_at'])
            ->distinct();
        if (isset($params['name'])) {
            $this->query->where('grade_names.name', 'LIKE', '%' . $params['name'] . '%');
        }
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }
    public function findAppTimes($uid, array $params)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';

        $this->query = DB::table('logs_active_time')
            ->where('logs_active_time.user_id', $uid)
            ->select(
                'logs_active_time.id',
                'logs_active_time.start_time',
                'logs_active_time.end_time'
            );
        if (isset($params['start'])) {
            $this->query->where('logs_active_time.start_time',  '>=', date('Y-m-d 00:00:00', strtotime($params['start'])));
        }
        if (isset($params['end'])) {
            $this->query->where('logs_active_time.end_time', '<=', date('Y-m-d 23:59:59', strtotime($params['end'])));
        }
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    // Old
    public function search(array $params)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';

        $this->query = DB::table('grades')
            ->join('grade_names','grade_names.grade_id', 'grades.id' )
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'chapters.id')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->select(
                'chapter_names.id AS id',
                'grade_names.name AS grade_name',
                'chapter_names.name AS chapter_name',
                'chapters.updated_at AS updated_at',
                'small_tests.pass_score_rate AS pass_score_rate'
            );
        if (isset($params['name'])) {
            $this->query->where('chapter_names.name', 'LIKE', '%' . $params['name'] . '%');
        }
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    public function searchBigtests(array $params)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';
        $this->query = DB::table('grades')
            ->join('big_tests', 'big_tests.grade_id', 'grades.id')
            ->join('grade_names','grade_names.grade_id', 'grades.id' )
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'chapters.id')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->select(
                'chapter_names.id AS id',
                'grade_names.name AS grade_name',
                'chapter_names.name AS chapter_name',
                'chapters.updated_at AS updated_at',
                'big_tests.pass_score_rate AS pass_score_rate'
            );
        if (isset($params['name'])) {
            $this->query->where('chapter_names.name', 'LIKE', '%' . $params['name'] . '%');
        }
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }


}