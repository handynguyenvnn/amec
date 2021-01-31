<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class ReportAccess extends Repository
{
    public function __construct()
    {
    }
    public $action = 'report_access';

    public function search(array $params)
    {
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';
        $this->query = $this->getSmallTestsSelectQuery();
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        if (isset($params['name'])) {
            $this->query->where('chapter_names.name', 'LIKE', '%' . $params['name'] . '%');
        }
        if (isset($params['lang'])) {
            $this->query->where('languages.lang', 'LIKE', '%' . $params['lang'] . '%');
        }
        $this->getSmallTestsGroupByQuery();
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }


    /**
     * Search all big tests
     * @param array $params
     * @return mixed
     */
    public function searchBigTests(array $params)
    {
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';
        $this->query = $this->getBigTestsSelectQuery();

        $this->query->orderBy($sortBy, $orderBy);

        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        if (isset($params['name'])) {
            $this->query->where('grade_names.name', 'LIKE', '%' . $params['name'] . '%');
        }
        if (isset($params['lang'])) {
            $this->query->where('languages.lang', 'LIKE', '%' . $params['lang'] . '%');
        }

        $this->getBigTestsGroupQuery();

        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    /**
     * Build big tests search query
     * @return mixed
     */
    private function getBigTestsSelectQuery() {
        return DB::table('logs_big_test')
            ->join('big_tests', 'big_tests.id', '=', 'logs_big_test.big_test_id')
            ->join('grade_names', 'grade_names.grade_id', '=', 'big_tests.grade_id')
            ->join('languages', 'languages.id', '=', 'grade_names.language_id')
            ->select(
                'logs_big_test.big_test_id as id', DB::raw('COUNT(logs_big_test.result) as total'),
                DB::raw('COUNT(case when logs_big_test.result = 1 then logs_big_test.result end) as pass_result'),
                DB::raw('COUNT(case when logs_big_test.result = 0 then logs_big_test.result end) as fail_result'),
                'languages.lang as lang','grade_names.name as grade_name');

    }

    /**
     * Build big tests group by query
     * @return mixed
     */
    public function getBigTestsGroupQuery() {
        return $this->query->groupBy('logs_big_test.big_test_id', 'languages.lang', 'grade_names.name');
    }

    public function getSmallTestsSelectQuery() {
        return DB::table('logs_small_test')
            ->join('versions', 'versions.relate_version', 'logs_small_test.relate_version')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->join('small_tests', function($join)
            {
                $join->on('small_tests.id', '=', 'logs_small_test.small_test_id');
                $join->on('small_tests.chapter_id', '=', 'chapters.id');
            })
            ->join('languages', 'chapter_names.language_id', 'languages.id')
            ->select(
                'chapters.id AS id', 'chapter_names.name as name',
                DB::raw('COUNT(logs_small_test.result) as total'),
                DB::raw('COUNT(case when logs_small_test.result = 1 then logs_small_test.result end) as pass_result'),
                DB::raw('COUNT(case when logs_small_test.result = 0 then logs_small_test.result end) as fail_result'),
                'languages.lang as lang', 'chapter_names.language_id as language_id'
            );
    }

    public function getSmallTestsGroupByQuery() {
        return $this->query->groupBy('logs_small_test.small_test_id', 'languages.lang', 'chapters.id',
            'chapter_names.name', 'chapter_names.language_id');
    }

    public function getSmallTestsCSV() {
        $this->query = $this->getSmallTestsSelectQuery();
        $smallTests = $this->getSmallTestsGroupByQuery()->get();
        $smallTestCSV = array();
        foreach($smallTests as $t) {
            $test = array();
            $test['id'] = $t->id;
            $test['name'] = $t->name;
            $test['lang'] = $t->lang;
            $test['result'] = $t->total.'('.$t->pass_result.'/'.$t->fail_result.')';
            array_push($smallTestCSV, $test);
        }
        return $smallTestCSV;
    }


    /**
     * Get big tests CSV
     * @return array
     */
    public function getBigTestsCSV() {
        $this->query = $this->getBigTestsSelectQuery();
        $bigTests = $this->getBigTestsGroupQuery()->get();
        $bigTestCSV = array();
        foreach($bigTests as $t) {
            $test = array();
            $test['id'] = $t->id;
            $test['name'] = $t->grade_name;
            $test['lang'] = $t->lang;
            $test['result'] = $t->total.'('.$t->pass_result.'/'.$t->fail_result.')';
            array_push($bigTestCSV, $test);
        }
        return $bigTestCSV;

    }

    public function reportCertificatesByYear()
    {
        $result = DB::table('possession_certificates')
            ->select(DB::raw('YEAR(issue_date) as year'), DB::raw('COUNT(id) as value') )
            ->groupby(DB::raw('YEAR(issue_date)'))
            ->orderBy('year', 'ASC')
            ->get();
        return $result;
    }

    public function reportCertificatesByMonth()
    {
        $result = DB::table('possession_certificates')
            ->select(DB::raw('MONTH(issue_date) as month'), DB::raw('COUNT(id) as value'))
            ->where(DB::raw('YEAR(issue_date)'), '=', DB::raw('YEAR(CURRENT_DATE)') )
            ->groupby('month')
            ->orderBy('month', 'ASC')
            ->get();
        return $result;
    }

    public function totalSmallTestStudents(){
        return DB::table('logs_chapter')->whereNotNull('relate_version')->sum('logs_chapter.management_number');
    }

    public function totalBigTestStudents(){
        return DB::table('logs_big_test')
            ->select( DB::raw('COUNT(user_id) as total'))->get()->first();
    }
    

    public function totalCertificatesIssuers(){
        return DB::table('possession_certificates')
            ->select( DB::raw('COUNT(id) as total'))->get()->first();
    }


}