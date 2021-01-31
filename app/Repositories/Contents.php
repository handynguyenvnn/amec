<?php

namespace App\Repositories;


use App\Libs\Constants\Constant;
use App\Models\Grade;
use App\Models\GradeName;
use App\Models\MessageSmallTest;
use App\Models\MessageBigTest;
use App\Models\Project;
use App\Models\Version;
use Illuminate\Support\Facades\DB;
use App\Libs\ApiCheckDate\CheckDate;
use Illuminate\Support\Facades\Session;

/**
 * This class manage all action of Grade
 * Class Grades
 * @package App\Repositories
 */
class Contents extends Repository
{
    public $action = 'contents';
    /**
     * Grades constructor.
     */
    public function __construct()
    {
        parent::__construct(new Grade());
    }

    //update sort table list
    public function sortable($rs, $_table = null, $_field = null, $_where = "") {
        //$maxNo = $minNo = $rs['minNo'];
        //var_dump($rs);
        $data = $rs['data'];
        if ($data) {
            foreach ($data AS $el) {
                DB::table($_table)->where('id', $el['id'])->update([$_field => intval($el['no'])]);
            }
        }

//        $xml = new Xmls();
//        $xml->resetFieldNo($_table, $_field, $_where);
    }
    /**
     * @param array $params
     * @return mixed
     */
    public function search(array $params)
    {
        return Grade::with(['grade_names' => function($q) {
                $q->where('language_id', Constant::LANG_JA_ID);
                $q->where('language_id', '!=' , null);
                $q->orderBy('grade_names.language_id');
            }])
            ->select('grades.id AS id', 'grades.grade_no')
            ->orderBy('grades.grade_no')
            ->get();
        // Set sort and paginate
        $params['action'] = $this->action;
        return DB::table('grades')
            ->join('grade_names', 'grade_names.grade_id', 'grades.id')
            ->where('grade_names.language_id', Constant::LANG_JA_ID )
            ->select('grade_names.name AS name', 'grades.id AS id', 'grades.grade_no')
            ->orderBy('grades.grade_no')
            ->get();
    }

    /**
     * @param $id
     * @return array
     */
    public function getGradeById($id)
    {
        $result = DB::table('grades')
            ->join('grade_names', 'grades.id', '=', 'grade_names.grade_id')
            ->where('grade_names.grade_id', $id)
            ->get();
        $arrayResult = array();
        foreach ($result as $temp)
        {
            $arrayResult['id'] = $id;
            $arrayResult['project_id'] = $temp->project_id;
            $arrayResult['content_type'] = $temp->content_type;
            if($temp->language_id == Constant::LANG_JA_ID)
            {
                $arrayResult['ja_name'] = $temp->name;
            }
            if($temp->language_id == Constant::LANG_EN_ID)
            {
                $arrayResult['en_name'] = $temp->name;
            }
            if($temp->language_id == Constant::LANG_VN_ID)
            {
                $arrayResult['vn_name'] = $temp->name;
            }
        }
        return $arrayResult;
    }
    /**
     * @param array $input
     */
    public function createGrade(array $input)
    {
        $grade = new Grade();
        $grade->project_id = $input['project_id'];
        $grade->grade_no = rand(10, 99);
        $grade->content_type = $input['content_type'];
        $grade->folder_id = str_random(10);
        $grade->file_id = str_random(10);
        $grade->save();
        if (isset($input['ja_name'])) {
            $this->createGradeName($grade->id, Constant::LANG_JA_ID, $input['ja_name']);
        }
        if (isset($input['en_name'])) {
            $this->createGradeName($grade->id, Constant::LANG_EN_ID, $input['en_name']);
        }
        if (isset($input['vn_name'])) {
            $this->createGradeName($grade->id, Constant::LANG_VN_ID, $input['vn_name']);
        }
        $this->saveMessageSmallTest($input);
        $this->saveMessageBigTest($input);
    }
    /**
     * @param $gradeId
     */
    public function deleteVersionByGradeId($gradeId)
    {
        $version = Version::where('grade_id', $gradeId);
        $version->delete();
    }
    /**
     * @param $id
     * @param $input
     */
    public function updateGrade($id, $input)
    {
        $grade = Grade::find($id);
        $grade->project_id=$input['project_id'];
        $grade->content_type=$input['project_id'];
        if(isset($input['jp_name']))
        {
            $this->updateGradeName($id, Constant::LANG_JA_ID, $input['jp_name']);
        }
        if(isset($input['en_name']))
        {
            $this->updateGradeName($id, Constant::LANG_EN_ID, $input['en_name']);
        }
        if(isset($input['vn_name']))
        {
            $this->updateGradeName($id, Constant::LANG_VN_ID, $input['vn_name']);
        }
    }
    /**
     * @param $gradeId
     * @param $langId
     * @param $name
     */
    public function updateGradeName($gradeId, $langId, $name)
    {
        $gradeName = GradeName::where('grade_id', $gradeId)->where('language_id', $langId)->first();
        $gradeName->name = $name;
        $gradeName->save();
    }
    /**
     * @param $gradeId
     * @param $langId
     * @param $name
     */
    public function createGradeName($gradeId, $langId, $name)
    {
        $gradeName = new GradeName();
        $gradeName->grade_id = $gradeId;
        $gradeName->language_id = $langId;
        $gradeName->name = $name;
        $gradeName->file_id = str_random(10);
        $gradeName->save();
    }

    /**
     * @param $input
     */
    public function saveMessageSmallTest($input)
    {
        if (isset($input['ja_small_passing_message'])) {
            $array = array(
                'passing_message' => $input['ja_small_passing_message'],
                'failed_message' => $input['ja_small_failed_message'],
                'correct_message' => $input['ja_small_correct_message'],
                'incorrect_message' => $input['ja_small_incorrect_message']
            );
            $this->createMessageSmallTestByLang(Constant::LANG_JA_ID, $array);
        }
        if (isset($input['en_small_passing_message'])) {
            $array = array(
                'passing_message' => $input['en_small_passing_message'],
                'failed_message' => $input['en_small_failed_message'],
                'correct_message' => $input['en_small_correct_message'],
                'incorrect_message' => $input['en_small_incorrect_message']
            );
            $this->createMessageSmallTestByLang(Constant::LANG_EN_ID, $array);
        }
        if (isset($input['vn_small_passing_message'])) {
            $array = array(
                'passing_message' => $input['vn_small_passing_message'],
                'failed_message' => $input['vn_small_failed_message'],
                'correct_message' => $input['vn_small_correct_message'],
                'incorrect_message' => $input['vn_small_incorrect_message']
            );
            $this->createMessageSmallTestByLang(Constant::LANG_VN_ID, $array);
        }
    }

    /**
     * @param $input
     */
    public function saveMessageBigTest($input)
    {
        if (isset($input['ja_big_passing_message'])) {
            $array = array(
                'passing_message' => $input['ja_big_passing_message'],
                'failed_message' => $input['ja_big_failed_message'],
                'correct_message' => $input['ja_big_correct_message'],
                'incorrect_message' => $input['ja_big_incorrect_message']
            );
            $this->createMessageBigTestByLang(Constant::LANG_JA_ID, $array);
        }
        if (isset($input['en_big_passing_message'])) {
            $array = array(
                'passing_message' => $input['en_big_passing_message'],
                'failed_message' => $input['en_big_failed_message'],
                'correct_message' => $input['en_big_correct_message'],
                'incorrect_message' => $input['en_big_incorrect_message']
            );
            $this->createMessageBigTestByLang(Constant::LANG_EN_ID, $array);
        }
        if (isset($input['vn_big_passing_message'])) {
            $array = array(
                'passing_message' => $input['vn_big_passing_message'],
                'failed_message' => $input['vn_big_failed_message'],
                'correct_message' => $input['vn_big_correct_message'],
                'incorrect_message' => $input['vn_big_incorrect_message']
            );
            $this->createMessageBigTestByLang(Constant::LANG_VN_ID, $array);
        }
    }

    /**
     * @param $langId
     * @param $array
     */
    public function createMessageSmallTestByLang($langId, $array)
    {
        $messagesSmallTest = new MessageSmallTest();
        $messagesSmallTest->small_test_id = 0;
        $messagesSmallTest->language_id = $langId;
        $messagesSmallTest->passing_message = $array['passing_message'];
        $messagesSmallTest->failed_message = $array['failed_message'];
        $messagesSmallTest->correct_message = $array['correct_message'];
        $messagesSmallTest->incorrect_message = $array['incorrect_message'];
        $messagesSmallTest->file_id = str_random(10);
        $messagesSmallTest->save();
    }

    /**
     * @param $langId
     * @param $array
     */
    public function createMessageBigTestByLang($langId, $array)
    {
        $messagesBigTest = new MessageBigTest();
        $messagesBigTest->big_test_id = 0;
        $messagesBigTest->language_id = $langId;
        $messagesBigTest->passing_message = $array['passing_message'];
        $messagesBigTest->failed_message = $array['failed_message'];
        $messagesBigTest->correct_message = $array['correct_message'];
        $messagesBigTest->incorrect_message = $array['incorrect_message'];
        $messagesBigTest->file_id = str_random(10);
        $messagesBigTest->save();
    }
    /**
     * This function show information of grade
     *
     * @param $date
     * @param $firstTime
     * @param $lang
     * @return mixed|null
     */
    public function showInformation($date, $firstTime, $lang)
    {
        $projectUpdatedAt = strtotime(Project::first()->select('updated_at')->get()[0]->updated_at);
        $date = strtotime($date);
        if (($firstTime == Constant::FIRST_TIME_TRUE) || !CheckDate::compareTwoTimes($date,$projectUpdatedAt)) {
            return $this->getGrade($lang);
        }
        if (($firstTime == Constant::FIRST_TIME_FALSE) && CheckDate::compareTwoTimes($date,$projectUpdatedAt)){
            return $grade = null;
        }
    }

    /**
     * This function get all Grades
     *
     * @param $lang
     * @return mixed
     */
    private function getGrade($lang){
        $result['grades'] = DB::table('languages')
            ->join('grade_names', 'languages.id', '=', 'grade_names.language_id')
            ->join('grades', 'grades.id', '=', 'grade_names.grade_id')
            ->where('languages.lang_code', $lang)
            ->where('grades.content_type', Constant::CONTENT_TYPE_GRADE_IS_COMA)
            ->select('grade_names.name as title', 'grade_names.grade_id as id')
            ->get();
        $result['project'] = Project::select('id', 'updated_at as date')->get();
        return $result;
    }
}