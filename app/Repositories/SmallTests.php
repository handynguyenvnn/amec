<?php

namespace App\Repositories;


use App\Models\Language;
use App\Models\LogBigTest;
use App\Models\MessageSmallTest;
use App\Models\SmallTest;
use App\Models\SmallTestQuestion;
use App\Models\SmallTestQuestionChoice;
use App\Models\SmallTestQuestionProblem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Libs\Constants\Constant;
use App\Models\LogSmallTest;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use App\Repositories\Xmls;


class SmallTests extends Repository
{

    public $action = 'small_tests';

    /**
     * SmallTest constructor.
     */
    public function __construct()
    {
        parent::__construct(new SmallTest());
    }

    public function postHistory($id, $point, $userId)
    {
        $versions = DB::table('versions')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->where('small_tests.id', $id)
            ->select('relate_version')
            ->orderBy('versions.created_at', 'desc')
            ->first();
        if (count($versions) > 0) {
            $relate_version = $versions->relate_version;
            $small_tests = SmallTest::find($id);
            if (!$small_tests) {
                return false;
            }
            $logs_small_test = new LogSmallTest();
            $logs_small_test->user_id = $userId;
            $logs_small_test->small_test_id = $id;
            $logs_small_test->point = $point;
            $logs_small_test->relate_version = $relate_version;
            $logs_small_test->control_no = $small_tests->control_no;
            $logs_small_test->result = ($point >= $small_tests->pass_score_rate) ? true : false;
            $logs_small_test->save();
            return $logs_small_test;
        } else {
            return false;
        }
    }

    public function listAll($chapterId)
    {
        return DB::table('chapters')
            ->where('chapters.id', $chapterId)
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->select('small_tests.id AS id')
            ->get();
    }

    public function search(array $params)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'asc';
        $this->query = DB::table('versions')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->select(
                'versions.name AS name',
                'small_tests.id AS id'
            );
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    public function searchById($id)
    {
        $this->query = SmallTest::where('id', $id)->get();
        $arrayResult = array();
        foreach ($this->query as $item) {
            $arrayResult['id'] = $item->id;
            $arrayResult['pass_score_rate'] = $item->pass_score_rate;
            $arrayResult['num_issues'] = $item->num_issues;
            $arrayResult['question_format'] = $item->question_format;
            $arrayResult['option_display_format'] = $item->option_display_format;
        }
        return $this->query = $arrayResult;
    }

    /**
     * @param $gradeId
     * @return mixed
     */
    public function searchSmallTestByGradeId($gradeId)
    {
        return DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->where('versions.grade_id', $gradeId)
            ->select(
                'small_tests.id AS id', 'versions.name AS version_name')->get();
    }

    public function getGradeIdVersionId($small_test_id)
    {
        $rs = DB::table('small_tests')
            ->join('chapters', 'chapters.id', 'small_tests.chapter_id')
            ->join('versions', 'versions.id', 'chapters.version_id')
            ->where('small_tests.id', $small_test_id)
            ->select(
                'small_tests.chapter_id',
                'chapters.version_id',
                'versions.grade_id'
            )->get(0);

        return $rs ? $rs[0] : null;
    }

    /**
     * @param $gradeId
     * @return mixed
     */
    public function getMessageByGradeId($gradeId)
    {

        $rs = DB::table('messages_small_test')
            ->join('languages', 'languages.id', 'messages_small_test.language_id')
            ->join('messages_big_test', 'messages_big_test.grade_id', 'messages_small_test.grade_id')
            ->where('messages_small_test.grade_id', $gradeId)
            ->select(
                'messages_big_test.id AS messages_big_test_id',
                'messages_small_test.id AS messages_small_test_id',
                'messages_small_test.small_test_id',
                'messages_big_test.big_test_id',
                'languages.lang_code',
                'messages_small_test.passing_message',
                'messages_small_test.failed_message',
                'messages_small_test.correct_message',
                'messages_small_test.incorrect_message'
            )->get();
//var_dump($rs);die;
        $data = [];
        if ($rs) {
            foreach ($rs AS $el) $data[$el->lang_code] = $el;
        }
        return $data;
    }

    public function searchSmallTestQuestionsBySmallTestId($smallTestId, $title = null)
    {
        $languages = Language::all();
        $arr_small_test = array();
        if($title && $title!=''){
            $small_tests = DB::table('small_tests')
                ->where('small_tests.id', $smallTestId)
                ->join('small_test_questions', 'small_test_questions.small_test_id', 'small_tests.id')
                ->where('small_test_questions.title','like', '%'. $title. '%')
                ->select(
                    'small_tests.control_no',
                    'small_test_questions.id AS id',
                    'small_test_questions.title AS title',
                    'small_test_questions.question_format AS question_format',
                    'small_test_questions.score AS score',
                    'small_test_questions.question_no AS question_no',
                    'small_tests.num_issues AS num_issues')
                ->orderBy('small_test_questions.question_no', 'ASC')
                ->orderBy('small_test_questions.id', 'DESC')
                ->get();
        }else {
            $small_tests = DB::table('small_tests')
                ->where('small_tests.id', $smallTestId)
                ->join('small_test_questions', 'small_test_questions.small_test_id', 'small_tests.id')
                ->select(
                    'small_tests.control_no',
                    'small_test_questions.id AS id',
                    'small_test_questions.title AS title',
                    'small_test_questions.question_format AS question_format',
                    'small_test_questions.score AS score',
                    'small_test_questions.question_no AS question_no',
                    'small_tests.num_issues AS num_issues')
                ->orderBy('small_test_questions.question_no', 'ASC')
                ->orderBy('small_test_questions.id', 'DESC')
                ->get();
        }
        foreach ($small_tests as $key => $small_test){
            $arr_small_test[$key]['id'] = $small_test->id;
            $arr_small_test[$key]['title'] = $small_test->title;
            $arr_small_test[$key]['score'] = $small_test->score;
            $arr_small_test[$key]['num_issues'] = $small_test->num_issues;
            $arr_small_test[$key]['question_no'] = $small_test->question_no;
            $arr_small_test[$key]['question_format'] = $small_test->question_format;
            $small_test_question_problems = DB::table('small_test_question_problems')
                ->where('small_test_question_problems.small_test_question_id', $small_test->id)
                ->get();
            foreach ($small_test_question_problems as $key_problems => $small_test_question_problem)
            {
                $arr_small_test[$key]['small_test_question_problems'][$small_test_question_problem->language_id]['id'] = $small_test_question_problem->id;
                $arr_small_test[$key]['small_test_question_problems'][$small_test_question_problem->language_id]['small_test_question_id'] = $small_test_question_problem->small_test_question_id;
                $arr_small_test[$key]['small_test_question_problems'][$small_test_question_problem->language_id]['problem_statement'] = $small_test_question_problem->problem_statement;
                $arr_small_test[$key]['small_test_question_problems'][$small_test_question_problem->language_id]['language_id'] = $small_test_question_problem->language_id;
                $arr_small_test[$key]['small_test_question_problems'][$small_test_question_problem->language_id]['image_path'] = $small_test_question_problem->image_path;
                $arr_small_test[$key]['small_test_question_problems'][$small_test_question_problem->language_id]['priority_check'] = $small_test_question_problem->priority_check;
                $arr_small_test[$key]['small_test_question_problems'][$small_test_question_problem->language_id]['video_path'] = $small_test_question_problem->video_path;
            }
            $small_test_question_choices = DB::table('small_test_question_choices')
                ->where('small_test_question_choices.small_test_question_id', $small_test->id)
                ->orderBy('option_value','ASC')
                ->get();
            if(count($small_test_question_choices)>0) {
                foreach ($small_test_question_choices as $key_choices => $small_test_question_choice) {
                    if(($small_test_question_choice->option_value)>0) {
                        $arr_small_test[$key]['small_test_question_choices'][$small_test_question_choice->language_id][$small_test_question_choice->option_value]['id'] = $small_test_question_choice->id;
                        $arr_small_test[$key]['small_test_question_choices'][$small_test_question_choice->language_id][$small_test_question_choice->option_value]['small_test_question_id'] = $small_test_question_choice->small_test_question_id;
                        $arr_small_test[$key]['small_test_question_choices'][$small_test_question_choice->language_id][$small_test_question_choice->option_value]['option_description'] = $small_test_question_choice->option_description;
                        $arr_small_test[$key]['small_test_question_choices'][$small_test_question_choice->language_id][$small_test_question_choice->option_value]['language_id'] = $small_test_question_choice->language_id;
                        $arr_small_test[$key]['small_test_question_choices'][$small_test_question_choice->language_id][$small_test_question_choice->option_value]['true_or_false'] = $small_test_question_choice->true_or_false;
                        $arr_small_test[$key]['small_test_question_choices'][$small_test_question_choice->language_id][$small_test_question_choice->option_value]['option_value'] = $small_test_question_choice->option_value;
                        $arr_small_test[$key]['small_test_question_choices'][$small_test_question_choice->language_id][$small_test_question_choice->option_value]['image_path'] = $small_test_question_choice->image_path;
                    }
                }
            }else{
                foreach ($languages as $k => $language){
                    $arr_small_test[$key]['small_test_question_choices'][$language->id] = array();
                }
            }
        }
        $total = count($arr_small_test);
        foreach ($languages as $k => $language){
            $arr_small_test[$total]['small_test_question_problems'][$language->id] = array();
            $arr_small_test[$total]['small_test_question_choices'][$language->id] = array();
        }
        return $arr_small_test;

    }

//    public function updateSmallTest($id = null, $input, $request, $languages = null, $xmls)
        public function updateSmallTest($id = null, $input, $request, $languages = null)
    {
        if(($id) && $id != '') {
            $smallTest = SmallTest::find($id);
        }else{
            $smallTest = new SmallTest();
        }
        $smallTest->num_issues = $input['num_issues'];
        $smallTest->pass_score_rate = $input['pass_score_rate'];
        $smallTest->question_format = $input['question_format'];
        $smallTest->option_display_format = $input['option_display_format'];
        $smallTest->save();
        if(isset($input['add_small_test_questions'])) {
            $small_test_questions = $input['add_small_test_questions'];
            if(isset($small_test_questions['title']) && $small_test_questions['title'] != '' ){
                $new_small_test_question = new SmallTestQuestion();
                $new_small_test_question->title = $small_test_questions['title'];
                $new_small_test_question->question_format = $small_test_questions['question_fomat'];
                $new_small_test_question->score = $small_test_questions['score'];
                $new_small_test_question->small_test_id = $smallTest->id;
                $new_small_test_question->save();

                $xmls = new Xmls();
                $xmls->resetFieldNo('small_test_questions', 'question_no', "small_test_id=" . ($smallTest->id));

                if(isset($small_test_questions['problems']) && count($small_test_questions['problems'])>0 ){
                    $problems = $small_test_questions['problems'];
                    foreach ($problems as $key_problems => $problem){
                        $this->updateSmallTestQuestionProblem($problem, $new_small_test_question->id, $key_problems);
                    }
                }
                if(isset($small_test_questions['choices']) && count($small_test_questions['choices'])>0 ){
                    $choices = $small_test_questions['choices'];
                    foreach ($choices as $key_choices => $choice){
                        $this->updateSmallTestQuestionChoice($choice, $new_small_test_question->id, $key_choices);
                    }
                }
                $xmls->resetFieldNo('small_test_question_choices', 'choice_no', "small_test_question_id=" . ($new_small_test_question->id));
            }
        }
        if(isset($input['small_test_questions'])) {
            $small_test_questions = $input['small_test_questions'];
            if(count($small_test_questions)>0){
                foreach ($small_test_questions as $key =>$small_test_question){
                    if(isset($small_test_question['title']))
//                    $this->updateSmallTestQuestion($smallTest->id, $small_test_question, $key, $xmls);
                    $this->updateSmallTestQuestion($smallTest->id, $small_test_question, $key);
                }

            }

        }
    }

    public function updateSmallTestQuestion($small_test_id=null, $input, $language_id = null)
//        public function updateSmallTestQuestion($small_test_id=null, $input, $language_id = null, Xmls $xmls)
    {
        if (isset($input['id']) && $input['id'] != '') {
            $smallTestQuestion = SmallTestQuestion::find($input['id']);
        } else {
            $smallTestQuestion = new SmallTestQuestion();
            $smallTestQuestion->question_no = intval(DB::table('small_test_questions')->where('small_test_id', $small_test_id)->max('question_no')) + 1;

        }
        $smallTestQuestion->small_test_id = $small_test_id;
        $smallTestQuestion->title = $input['title'];
        $smallTestQuestion->question_format = $input['question_fomat'];
        $smallTestQuestion->score = $input['score'];
        $smallTestQuestion->save();

        $xmls = new Xmls();
        $xmls->resetFieldNo('small_test_questions', 'question_no', "small_test_id=" . $small_test_id);

        if(isset($input['problems'])){
            $problems = $input['problems'];
            if(count($problems)>0){
                foreach ($problems as $key => $problem){
                    $this->updateSmallTestQuestionProblem($problem, $smallTestQuestion->id, $key);
                }
            }
        }
        if(isset($input['choices'])){
            $choices = $input['choices'];
            if(count($choices)>0){
                foreach ($choices as $key_choice => $choice){
                    $this->updateSmallTestQuestionChoice($choice, $smallTestQuestion->id, $key_choice);
                }
            }
        }

        $xmls->resetFieldNo('small_test_question_choices', 'choice_no', "small_test_question_id=" . ($smallTestQuestion->id));
    }
    public function updateSmallTestQuestionChoice($inputs, $small_test_question_id = null, $lang_id = null)
    {
        $year = date('Y');
        $month = date('m');
        if(count($inputs)>0){
            foreach ($inputs as $key => $input){
                if(!is_numeric($key)){
                    continue;
                }else {
                    if((isset($input['option_description']) && $input['option_description']!= '') || (isset($input['true_or_false']) && $input['true_or_false']!= '') || isset($input['image_path'])) {
                        if (isset($input['id']) && $input['id'] != '') {
                            $smallTestQuestionChoice = SmallTestQuestionChoice::find($input['id']);
                        } else {
                            $smallTestQuestionChoice = new SmallTestQuestionChoice();
                        }
                        $smallTestQuestionChoice->small_test_question_id = $small_test_question_id;
                        $smallTestQuestionChoice->option_description = $input['option_description'];
                        $smallTestQuestionChoice->language_id = $lang_id;
                        $smallTestQuestionChoice->option_value = $key;
                        $true_or_false = 0;
                        if ((isset($input['true_or_false']) && $input['true_or_false'] == 'on') || (isset($input['true_or_false']) && $input['true_or_false'] == 1)) {
                            $true_or_false = 1;
                        }
                        $smallTestQuestionChoice->true_or_false = $true_or_false;
                        if ($input['image_path']) {
                            $image = $input['image_path'];
                            $nameImage = str_random(15) . pathinfo($image)['filename'];
                            $extImage = $image->guessClientExtension();
                            if (Storage::disk('s3')->putFileAs('image/small_tests/'.$year.DS.$month, $image, "{$nameImage}.{$extImage}", "public")) {
                                $smallTestQuestionChoice->image_path = 'image/small_tests/'.$year.DS.$month . DS . $nameImage . '.' . $extImage;
                            } else {
                                $smallTestQuestionChoice->image_path = Constant::NO_IMAGE;
                            }
                        }
                        $smallTestQuestionChoice->save();
                    }
                }
        }
    }
    }
    public function updateSmallTestQuestionProblem($input, $small_test_question_id = null, $lang_id = null)
    {
        $year = date('Y');
        $month = date('m');
            if(isset($input['id']) && $input['id'] != '') {
                $smallTestQuestionProblem = SmallTestQuestionProblem::find($input['id']);
            }
            else{
                $smallTestQuestionProblem = new SmallTestQuestionProblem();
            }
            $smallTestQuestionProblem->small_test_question_id = $small_test_question_id;
            $smallTestQuestionProblem->problem_statement = $input['problem_statement'];
            $smallTestQuestionProblem->language_id = $lang_id;
            $priority_check = 0;
            if(isset($input['priority_check']) && $input['priority_check']=='on' ) {
                $priority_check = 1;
            }
            $smallTestQuestionProblem->priority_check = $priority_check;
            if (isset($input['image_path'])) {
                $image = $input['image_path'];
                $nameImage = str_random(15) . pathinfo($image)['filename'];
                $extImage = $image->guessClientExtension();
                if (Storage::disk('s3')->putFileAs('image/small_tests/'.$year.DS.$month, $image, "{$nameImage}.{$extImage}", "public")) {
                    $smallTestQuestionProblem->image_path = 'image/small_tests/'.$year.DS.$month . DS . $nameImage . '.' . $extImage;
                } else {
                    $smallTestQuestionProblem->image_path = Constant::NO_IMAGE;
                }
            }
            if (isset($input['video_path'])) {
                $video = $input['video_path'];
                $nameVideo = str_random(15) . pathinfo($video)['filename'];
                $extVideo = $video->guessClientExtension();
                if (Storage::disk('s3')->putFileAs('video/small_tests/'.$year.DS.$month, $video, "{$nameVideo}.{$extVideo}", "public")) {
                    $smallTestQuestionProblem->video_path = 'video/small_tests/'.$year.DS.$month . DS . $nameVideo . '.' . $extVideo;
                } else {
                    $smallTestQuestionProblem->video_path = Constant::NO_VIDEO;
                }
            }
            $smallTestQuestionProblem->save();
    }

    public function fetchALlAPI($lang)
    {
        return array(
            'questions' => $this->getQuestions($lang),
            'answers' => $this->getAnswers($lang),
            'messages' => $this->getMessages($lang),

        );
    }

    private function getQuestions($lang)
    {
        return DB::table('small_tests')
            ->join('small_test_questions', 'small_test_questions.small_test_id', 'small_tests.id')
            ->join('small_test_question_problems', 'small_test_question_problems.small_test_question_id', 'small_test_questions.id')
            ->join('languages', 'small_test_question_problems.language_id', 'languages.id')
            ->where('languages.lang_code', $lang)
            ->select(
                'small_test_questions.title AS title',
                'small_test_questions.id AS id',
                'small_tests.chapter_id AS chapter_id',
                'small_test_question_problems.problem_statement AS question',
                'small_test_question_problems.image_path AS image_path',
                'small_test_question_problems.video_path AS video_path'
            )
            ->get();

    }

    private function getAnswers($lang)
    {
        return DB::table('small_tests')
            ->join('small_test_questions', 'small_test_questions.small_test_id', 'small_tests.id')
            ->join('small_test_question_choices', 'small_test_question_choices.small_test_question_id', 'small_test_questions.id')
            ->join('languages', 'small_test_question_choices.language_id', 'languages.id')
            ->where('languages.lang_code', $lang)
            ->select(
                'small_test_question_choices.id AS id',
                'small_test_questions.id AS question_id',
                'small_tests.chapter_id AS chapter_id',

                'small_test_question_choices.option_description AS description',
                'small_test_question_choices.option_value AS correct',
                'small_test_question_choices.image_path AS image_path'
            )
            ->get();

    }

    private function getMessages($lang)
    {
        return DB::table('small_tests')
            ->join('messages_small_test', 'messages_small_test.small_test_id', 'small_tests.id')
            ->join('languages', 'messages_small_test.language_id', 'languages.id')
            ->where('languages.lang_code', $lang)
            ->select(
                'messages_small_test.id AS id',
                'small_tests.id AS small_test_id',
                'messages_small_test.passing_message AS passing_message',
                'messages_small_test.failed_message AS failed_message',
                'messages_small_test.correct_message AS correct_message',
                'messages_small_test.incorrect_message AS incorrect_message'

            )
            ->get();

    }

    public function fetchALl($languageId)
    {
        return DB::table('small_tests')
            ->join('messages_small_test', 'messages_small_test.small_test_id', 'small_tests.id')
            ->join('small_test_questions', 'small_test_questions.small_test_id', 'small_tests.id')
            ->join('small_test_question_choices', 'small_test_question_choices.small_test_question_id', 'small_test_questions.id')
            ->join('small_test_question_problems', 'small_test_question_problems.small_test_question_id', 'small_test_questions.id')
            ->where('small_test_question_problems.language_id', $languageId)
            ->where('small_test_question_choices.language_id', $languageId)
            ->where('messages_small_test.language_id', $languageId)
            ->select(
                'small_tests.id AS id',
                'small_tests.chapter_id AS chapter_id',
                'small_tests.num_issues AS num_issues',
                'small_tests.pass_score_rate AS pass_score_rate',
                'small_tests.question_format AS question_format',
                'small_tests.option_display_format AS option_display_format',
                'small_tests.control_no AS control_no',
                'small_tests.file_id AS file_id',
                'small_tests.folder_id AS folder_id',
                'small_tests.management_numbers AS management_numbers',

                'small_test_questions.id AS small_test_question_id',
                'small_test_questions.small_test_id AS small_test_question_small_test_id',
                'small_test_questions.title AS small_test_question_title',
                'small_test_questions.question_format AS small_test_question_question_format',
                'small_test_questions.score AS small_test_question_score',
                'small_test_questions.file_id AS small_test_question_file_id',
                'small_test_questions.folder_id AS small_test_question_folder_id',

                'small_test_question_problems.id AS small_test_question_problem_id',
                'small_test_question_problems.small_test_question_id AS small_test_question_problem_small_test_question_id',
                'small_test_question_problems.problem_statement AS small_test_question_problem_problem_statement',

                'small_test_question_problems.language_id AS small_test_question_problem_language_id',
                'small_test_question_problems.image_path AS small_test_question_problem_image_path',
                'small_test_question_problems.priority_check AS small_test_question_problem_priority_check',
                'small_test_question_problems.file_id AS small_test_question_problem_file_id',
                'small_test_question_problems.video_path AS small_test_question_problem_video_path',

                'small_test_question_choices.id AS small_test_question_choice_id',
                'small_test_question_choices.small_test_question_id AS small_test_question_choice_small_test_question_id',
                'small_test_question_choices.option_description AS small_test_question_choice_option_description',
                'small_test_question_choices.choice_no AS small_test_question_choice_choice_no',
                'small_test_question_choices.language_id AS small_test_question_choice_language_id',
                'small_test_question_choices.option_value AS small_test_question_choice_option_value',
                'small_test_question_choices.image_path AS 	small_test_question_choice_image_path',
                'small_test_question_choices.file_id_explanation AS small_test_question_choice_file_id_explanation',
                'small_test_question_choices.file_id_setting AS small_test_question_choice_file_id_setting',
                'small_test_question_choices.folder_id AS small_test_question_choice_folder_id',

                'messages_small_test.id AS messages_small_test_id',
                'messages_small_test.grade_id AS messages_small_test_grade_id',
                'messages_small_test.small_test_id AS messages_small_test_small_test_id',
                'messages_small_test.language_id AS messages_small_test_small_test_language_id',
                'messages_small_test.passing_message AS messages_small_test_passing_message',
                'messages_small_test.failed_message AS messages_small_test_failed_message',
                'messages_small_test.correct_message AS messages_small_test_correct_message',
                'messages_small_test.incorrect_message AS messages_small_test_incorrect_message',
                'messages_small_test.file_id AS messages_small_test_file_id'
            )
            ->get();
    }

    public function processExportXML($languageId)
    {
        $lang = count(Language::find($languageId)) > 0 ? Language::find($languageId)->lang_code : '';
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' . '<共通 lang="' . $lang . '" />');
        $small_tests = SmallTest::all();
        if (count($small_tests) > 0) {
            foreach ($small_tests as $small_test) {
                $messages_small_test = MessageSmallTest::where('small_test_id', $small_test->id)
                    ->where('language_id', $languageId)
                    ->first();
                if (count($messages_small_test) > 0) {
                    $xml->addChild('合格メッセージ', $messages_small_test->passing_message);
                    $xml->addChild('不合格メッセージ', $messages_small_test->failed_message);
                    $xml->addChild('正解メッセージ', $messages_small_test->correct_message);
                    $xml->addChild('不正解メッセージ', $messages_small_test->correct_message);
                }
                $small_test_questions = SmallTestQuestion::where('small_test_id', $small_test->id)->get();
                foreach ($small_test_questions as $key_stq => $v_small_test_question) {
                    $small_test_problem = $xml->addChild('小テスト問題' . ++$key_stq);
                    $small_test_problems = SmallTestQuestionProblem::where('small_test_question_id', $v_small_test_question->id)
                        ->where('language_id', $languageId)
                        ->first();
                    if (count($small_test_problems) > 0) {
                        $small_test_problem->addChild('問題形式', $v_small_test_question->question_format);
                        $small_test_problem->addChild('配点', $v_small_test_question->score);
                        $small_test_problem->addChild('問題文', $small_test_problems->problem_statement);
                        $small_test_problem_image = $small_test_problem->addChild('画像', $small_test_problems->image_path);
                        $small_test_problem_video = $small_test_problem->addChild('動画', $small_test_problems->video_path);
                        if ($small_test_problems->priority_check == 0) {
                            $priority_check = 'false';
                        } else {
                            $priority_check = 'true';
                        }
                        $small_test_problem_image->attributes('優先チェック', $priority_check);
                        $small_test_problem_video->attributes('優先チェック', $priority_check);
                    }
                    $small_test_question_choices = SmallTestQuestionChoice::where('small_test_question_id', $v_small_test_question->id)
                        ->where('language_id', $languageId)->get();
                    foreach ($small_test_question_choices as $key_stqc => $v_small_test_question_choice) {
                        $small_test_question_choice = $small_test_problem->addChild('選択肢' . ++$key_stqc);
                        $small_test_question_choice->addChild('選択肢説明', $v_small_test_question_choice->option_description);
                    }
                }
            }
        }
        return $xml->asXML();
    }

    public function processImportXML($inputs)
    {
//        DB::table('small_tests')->truncate();
//        DB::table('small_test_questions')->truncate();
//        DB::table('messages_small_test')->where('messages_small_test.language_id', $inputs['小テスト'][0]['メッセージ']['@attributes']['language_id'])->delete();
//        DB::table('small_test_question_problems')->where('small_test_question_choices.language_id', $inputs['小テスト'][0]['小テスト問題']['@attributes']['問題']['@attributes']['language_id'])->truncate();
//        DB::table('small_test_question_choices')->where('small_test_question_choices.language_id', $inputs['小テスト'][0]['小テスト問題']['@attributes']['選択肢']['@attributes']['language_id'])->truncate();
        foreach ($inputs['小テスト'] as $key => $temp) {
            $small_test_check_exists = SmallTest::find($temp['@attributes']['id']);
            if ($small_test_check_exists == null) {
                $small_tests = new SmallTest();
            } else {
                $small_tests = SmallTest::find($temp['@attributes']['id']);
            }
            $small_tests->id = $temp['@attributes']['id'];
            $small_tests->chapter_id = $temp['@attributes']['chapter_id'];
            $small_tests->num_issues = $temp['@attributes']['num_issues'];
            $small_tests->pass_score_rate = $temp['@attributes']['pass_score_rate'];
            $small_tests->question_format = $temp['@attributes']['question_format'];
            $small_tests->option_display_format = $temp['@attributes']['option_display_format'];
            $small_tests->control_no = $temp['@attributes']['control_no'];
            $small_tests->file_id = $temp['@attributes']['file_id'];
            $small_tests->folder_id = $temp['@attributes']['folder_id'];
            $small_tests->management_numbers = $temp['@attributes']['management_numbers'];
            $small_tests->save();

            $small_test_question_check_exists = SmallTestQuestion::find($temp['小テスト問題']['@attributes']['id']);
            if ($small_test_question_check_exists == null) {
                $small_test_questions = new SmallTestQuestion();
            } else {
                $small_test_questions = SmallTestQuestion::find($temp['小テスト問題']['@attributes']['id']);
            }
            $small_test_questions->id = $temp['小テスト問題']['@attributes']['id'];
            $small_test_questions->small_test_id = $temp['小テスト問題']['@attributes']['small_test_id'];
            $small_test_questions->title = $temp['小テスト問題']['@attributes']['title'];
            $small_test_questions->question_format = $temp['小テスト問題']['@attributes']['question_format'];
            $small_test_questions->score = $temp['小テスト問題']['@attributes']['score'];
            $small_test_questions->file_id = $temp['小テスト問題']['@attributes']['file_id'];;
            $small_test_questions->folder_id = $temp['小テスト問題']['@attributes']['folder_id'];
            $small_test_questions->save();

            $messages_small_test_check_exists = MessageSmallTest::find($temp['メッセージ']['@attributes']['id']);
            if ($messages_small_test_check_exists == null) {
                $small_test_questions = new SmallTestQuestion();
            } else {
                $small_test_questions = MessageSmallTest::find($temp['メッセージ']['@attributes']['id']);
            }
            $small_test_questions->id = $temp['メッセージ']['@attributes']['id'];
            $small_test_questions->grade_id = $temp['メッセージ']['@attributes']['grade_id'];
            $small_test_questions->small_test_id = $temp['メッセージ']['@attributes']['small_test_id'];
            $small_test_questions->language_id = $temp['メッセージ']['@attributes']['language_id'];
            $small_test_questions->passing_message = $temp['メッセージ']['@attributes']['passing_message'];
            $small_test_questions->failed_message = $temp['メッセージ']['@attributes']['failed_message'];;
            $small_test_questions->correct_message = $temp['メッセージ']['@attributes']['correct_message'];
            $small_test_questions->incorrect_message = $temp['メッセージ']['@attributes']['incorrect_message'];
            $small_test_questions->file_id = $temp['メッセージ']['@attributes']['file_id'];
            $small_test_questions->save();

            $small_test_question_problem_check_exists = SmallTestQuestionProblem::find($temp['小テスト問題']['@attributes']['問題']['@attributes']['id']);
            if ($small_test_question_problem_check_exists == null) {
                $small_test_question_problems = new SmallTestQuestionProblem();
            } else {
                $small_test_question_problems = SmallTestQuestionProblem::find($temp['小テスト問題']['@attributes']['問題']['@attributes']['id']);
            }
            $small_test_question_problems->id = $temp['小テスト問題']['@attributes']['問題']['@attributes']['id'];
            $small_test_question_problems->small_test_question_id = $temp['小テスト問題']['@attributes']['問題']['@attributes']['small_test_question_id'];
            $small_test_question_problems->problem_statement = $temp['小テスト問題']['@attributes']['問題']['@attributes']['problem_statement'];
            $small_test_question_problems->language_id = $temp['小テスト問題']['@attributes']['問題']['@attributes']['language_id'];
            $small_test_question_problems->image_path = $temp['小テスト問題']['@attributes']['問題']['@attributes']['image_path'];
            $small_test_question_problems->priority_check = $temp['小テスト問題']['@attributes']['問題']['@attributes']['priority_check'];;
            $small_test_question_problems->file_id = $temp['小テスト問題']['@attributes']['問題']['@attributes']['file_id'];
            $small_test_question_problems->video_path = $temp['小テスト問題']['@attributes']['問題']['@attributes']['video_path'];
            $small_test_question_problems->save();
            $small_test_question_choice_check_exists = SmallTestQuestionChoice::find($temp['小テスト問題']['@attributes']['選択肢']['@attributes']['id']);
            if ($small_test_question_choice_check_exists == null) {
                $small_test_question_choices = new SmallTestQuestionChoice();
            } else {
                $small_test_question_choices = SmallTestQuestionChoice::find($temp['小テスト問題']['@attributes']['選択肢']['@attributes']['id']);
            }
            $small_test_question_choices->id = $temp['小テスト問題']['@attributes']['選択肢']['@attributes']['id'];
            $small_test_question_choices->small_test_question_id = $temp['小テスト問題']['@attributes']['選択肢']['@attributes']['small_test_question_id'];
            $small_test_question_choices->option_description = $temp['小テスト問題']['@attributes']['選択肢']['@attributes']['option_description'];
            $small_test_question_choices->choice_no = $temp['小テスト問題']['@attributes']['選択肢']['@attributes']['choice_no'];
            $small_test_question_choices->language_id = $temp['小テスト問題']['@attributes']['選択肢']['@attributes']['language_id'];
            $small_test_question_choices->option_value = $temp['小テスト問題']['@attributes']['選択肢']['@attributes']['option_value'];;
            $small_test_question_choices->image_path = $temp['小テスト問題']['@attributes']['選択肢']['@attributes']['image_path'];
            $small_test_question_choices->file_id_explanation = $temp['小テスト問題']['@attributes']['選択肢']['@attributes']['file_id_explanation'];
            $small_test_question_choices->file_id_setting = $temp['小テスト問題']['@attributes']['選択肢']['@attributes']['file_id_setting'];
            $small_test_question_choices->folder_id = $temp['小テスト問題']['@attributes']['選択肢']['@attributes']['folder_id'];
            $small_test_question_choices->save();
        }
    }
}