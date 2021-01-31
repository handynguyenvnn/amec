<?php

namespace App\Repositories;

use App\Models\BigTest;
use App\Models\Coma;
use App\Models\ComaLanguage;
use App\Models\Grade;
use App\Models\LogChapter;
use App\Models\LogSmallTest;
use App\Models\SmallTest;
use App\Models\SmallTestQuestionProblem;
use Illuminate\Support\Facades\DB;
use App\Libs\ApiCheckDate\CheckDate;
use App\Libs\Constants\Constant;
use Illuminate\Support\Facades\Session;

/**
 * This class manage all action of Comas
 * Class Comas
 * @package App\Repositories
 */
class Comas extends Repository
{
    public $action = 'comas';
    /**
     * Grades constructor.
     */
    public function __construct()
    {
        parent::__construct(new Coma());
    }

    /**
     * This function get content type of grade
     * 
     * @param $gradeId
     * @return string
     */
    protected function getContentTypeGrade($gradeId)
    {
        $checkType = DB::table('grades')
            ->where('grades.id', $gradeId)
            ->select('grades.content_type as content_type')
            ->first();
        if (count ($checkType)>0)
            return $checkType->content_type;
        else
            return false;
    }

    /**
     * @param $chapterId
     * @return bool
     */
    protected function checkContentTypeGradeOfChapterId($chapterId)
    {
        $checkType = DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->where('chapters.id', $chapterId)
            ->select('grades.content_type as content_type')
            ->first();
        if (count ($checkType)>0)
            return $checkType->content_type;
        else
            return false;
    }
    /**
     * @param array $params
     * @return mixed
     */
    public function search(array $params)
    {
        // Set sort and paginate
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 100;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'asc';
        // Start search query
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['subject'])) {
            $this->query->where('frame_name', 'LIKE', '%' . $params['coma_name'] . '%');
        }

        // Set session search params
        Session::put('params', $params);

        return $this->query->paginate($perPage);
    }

    /**
     * @param $name
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function searchComaByAjax($name, $chapterId){
        return DB::table('chapters')
            ->where('chapters.id', $chapterId)
            ->join('comas', 'comas.chapter_id', 'chapters.id')
            ->where('frame_name', 'LIKE', '%' . $name . '%')
            ->get();
    }
    /**
     * @param $id
     * @return array
     */
    public function getChapterComaByAjax($id){
        $result = DB::table('comas')
            ->where('comas.id', $id)
            ->join('coma_languages', 'coma_languages.coma_id','comas.id')
            ->join('languages', 'languages.id','coma_languages.language_id')
            ->join('coma_categories','comas.coma_category_id','coma_categories.id')
            ->select('comas.id AS id',
                    'comas.frame_name AS name',
                    'coma_languages.language_id AS language_id',
                    'coma_languages.id AS coma_language_id',
                    'coma_languages.description AS description',
                    'comas.coma_category_id AS coma_category_id',
                    'coma_categories.frame_category_name AS coma_category_name',
                    'languages.lang AS lang',
                    'languages.lang_code',
                    'coma_languages.image_path AS image_path',
                    'coma_languages.music_path AS music_path',
                    'coma_languages.video_path AS video_path',
                    'coma_languages.priority_check AS priority_check'
                )
            ->get();
        $arrayResult = array();
        foreach ($result as $item) {
            $lang_code = $item->lang_code;
            $arrayResult["{$lang_code}_description"] = $item->description;
            $arrayResult["{$lang_code}_image_path"] = $item->image_path;
            $arrayResult["{$lang_code}_music_path"] = $item->music_path;
            $arrayResult["{$lang_code}_video_path"] = $item->video_path;
            $arrayResult["{$lang_code}_coma_language_id"] = $item->coma_language_id;
            $arrayResult['name'] = $item->name;
            $arrayResult['id'] = $item->id;
            $arrayResult['coma_category_id'] = $item->coma_category_id;
            $arrayResult['coma_category_name'] = $item->coma_category_name;
            $arrayResult["{$lang_code}_priority_check"] = $item->priority_check;
        }
        return $arrayResult;
    }

    /**
     * @param $lang
     * @param $gradeId
     * @param $userId
     * @return mixed
     */
    private function getChapterComa($lang, $gradeId, $userId)
    {
        $results = DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->join('languages', 'languages.id', 'chapter_names.language_id')
            ->where('grades.id', $gradeId)
            ->where('versions.published', Constant::PUBLISHED)
            ->where('chapter_names.name', '!=', '')
            ->where('languages.lang_code', $lang)
            ->select(
                'chapter_names.name AS name',
                'chapters.id AS id',
                'chapters.chapter_no AS chapter_no',
                'chapters.version_id AS version_id',
                'chapters.updated_at AS date'
            )
            ->get();
        $arrayChapter = [];
        foreach ($results as $key => $temp)
        {
                $arrayChapter[$key]['id'] = $temp->id;
                $arrayChapter[$key]['name'] = $temp->name;
                $arrayChapter[$key]['version_id'] = $temp->version_id;
                $arrayChapter[$key]['chapter_no'] = $temp->chapter_no;
                $arrayChapter[$key]['date'] = $temp->date;
                $arrayChapter[$key]['status'] = $this->getStatusChapter($temp->id, $userId);
        }
        return $arrayChapter;
    }
    public function getStatusChapter($chapterId=null, $userId=null)
    {
        $status = Constant::STATUS_NO_TEST;
        $small_tests = SmallTest::where('chapter_id', $chapterId)->first();
        if(count($small_tests)>0)
        {
            $logs_small_test = LogSmallTest::where('user_id', $userId)
                ->where('small_test_id',$small_tests->id )
                ->orderBy('point', 'desc')
                ->first();
            if(count($logs_small_test)>0)
            {
                if ($logs_small_test->result ==1){
                    return $status = Constant::STATUS_TEST_PASS;
                }else{
                    return $status = Constant::STATUS_TEST_NO_PASS;
                }
            }else{
                return $status;
            }


        }else{
            return $status;
        }
    }

    /**
     * This function get coma
     *
     * @param $lang
     * @param $gradeId
     */
    private function getComaComa($lang, $gradeId)
    {
        $results = DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('comas', 'comas.chapter_id', 'chapters.id')
            ->join('coma_categories', 'comas.coma_category_id', 'coma_categories.id')
            ->join('coma_languages', 'coma_languages.coma_id', 'comas.id')
            ->join('languages', 'languages.id', 'coma_languages.language_id')
            ->where('grades.id', $gradeId)
            ->where('versions.published', Constant::PUBLISHED)
            ->where('languages.lang_code', $lang)
            ->select(
                'comas.frame_name as name',
                'comas.id as id',
                'comas.chapter_id as chapter_id',
                'comas.updated_at as date',
                'comas.frame_no  as frame_no',
                'coma_categories.coma_category_no as coma_category_no',
                'coma_languages.id as coma_language_id',
                'coma_languages.priority_check as priority_check',
                'coma_languages.music_path as music_link',
                'coma_languages.image_path as picture_link',
                'coma_languages.video_path as video_link',
                'coma_languages.description as description'
            )
            ->get();

        foreach ($results as $key => $result) {
            if ($result->priority_check == 0) {
                $coma_languages = ComaLanguage::where('priority_check', Constant::PRIORITY_CHECK_ON)
                    ->where('coma_id', $result->id)
                    ->first();
                $music_link = (count($coma_languages) > 0) ? $coma_languages->music_path : $result->music_link;
                $picture_link = (count($coma_languages) > 0) ? $coma_languages->image_path : $result->picture_link;
                $video_link = (count($coma_languages) > 0) ? $coma_languages->video_path : $result->video_link;
            } else {
                $music_link = $result->music_link;
                $picture_link = $result->picture_link;
                $video_link = $result->video_link;
            }
            $arrResult[$key] = array(
                'name' => $result->name,
                'id' => $result->id,
                'chapter_id' => $result->chapter_id,
                'date' => $result->date,
                'frame_no' => $result->frame_no,
                'coma_category_no' => $result->coma_category_no,
                'coma_language_id' => $result->coma_language_id,
                'priority_check' => $result->priority_check,
                'music_link' => $music_link ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$music_link : '',
                'picture_link' => $picture_link ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$picture_link : '',
                'video_link' => $video_link ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$video_link : '',
                'description' => $result->description
            );

        }
        return $arrResult;
    }

    /**
     * This function get grade coma
     * @param $id
     * @return $this
     */
    private function getGradeComa( $id)
    {
        return DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->where('grades.id', $id)
            ->where('versions.published', Constant::PUBLISHED)
            ->select(
                'grades.id as id',
                'versions.release_date_chapter as release_date_chapter')
            ->get();
    }

    /**
     * @param $date
     * @param $firstTime
     * @param $lang
     * @param $gradeId
     * @param $userId
     * @return array|bool|null
     */
    public function getComa($date, $firstTime, $lang, $gradeId, $userId)
    {
        if ((int)$this->getContentTypeGrade($gradeId) != Constant::COMA) {
            return false;
        } else {
            $release_date_chapter = DB::table('grades')
                ->join('versions', 'versions.grade_id', 'grades.id')
                ->where('grades.id', $gradeId)
                ->where('versions.published', Constant::PUBLISHED)
                ->get();
            if (count($release_date_chapter) > 0) {
                $release_date_chapter = $release_date_chapter[0]->release_date_chapter;
                $gradeUpdatedTime = strtotime($release_date_chapter);
                $date = strtotime($date);
                if (($firstTime == Constant::FIRST_TIME_FALSE) && !CheckDate::compareTwoTimes($date, $gradeUpdatedTime)) {
                    return null;
                }
                if (($firstTime == Constant::FIRST_TIME_TRUE) || CheckDate::compareTwoTimes($date, $gradeUpdatedTime)) {
                    return array(
                        'chapter' => $this->getChapterComa($lang, $gradeId, $userId),
                        'coma' => $this->getComaComa($lang, $gradeId),
                        'grade' => $this->getGradeComa($gradeId)
                    );
                }
            } else {
                return null;
            }
        }
    }
    /**
     * This function get question of question
     *
     * @param $lang
     * @param $chapterId
     * @return mixed
     */
    private function getQuestionQuestion($lang, $chapterId)
    {
        $results = DB::table('chapters')
            ->where('chapters.id', $chapterId)
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->join('small_test_questions', 'small_test_questions.small_test_id', 'small_tests.id')
            ->join('small_test_question_problems', 'small_test_question_problems.small_test_question_id', 'small_test_questions.id')
            ->join('languages', 'languages.id','small_test_question_problems.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'small_tests.id AS test_id',
                'small_test_questions.title as title',
                'small_test_questions.id as small_test_question_id',
                'small_test_questions.question_format as question_format',
                'small_test_questions.question_no as question_no',
                'small_test_question_problems.image_path as picture_link',
                'small_test_question_problems.priority_check as priority_check',
                'small_test_question_problems.video_path as video_link',
                'small_test_question_problems.problem_statement as question')
            ->get();
        $arrResult = [];
        foreach ($results as $key => $result){
            if ($result->priority_check == 0) {
                $small_test_question_problems = SmallTestQuestionProblem::where('priority_check', Constant::PRIORITY_CHECK_ON)
                    ->where('small_test_question_id', $result->small_test_question_id)
                    ->first();
                $picture_link = (count($small_test_question_problems) > 0) ? $small_test_question_problems->image_path : $result->picture_link;
                $video_link = (count($small_test_question_problems) > 0) ? $small_test_question_problems->video_path : $result->video_link;
            } else {
                $picture_link = $result->picture_link;
                $video_link = $result->video_link;
            }
            $arrResult[$key]['test_id'] = $result->test_id;
            $arrResult[$key]['title'] = $result->title;
            $arrResult[$key]['small_test_question_id'] = $result->small_test_question_id;
            $arrResult[$key]['question_format'] = $result->question_format;
            $arrResult[$key]['question_no'] = $result->question_no;
            $arrResult[$key]['picture_link'] = $picture_link ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$picture_link : '';
            $arrResult[$key]['video_link'] = $video_link ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$video_link : '';
            $arrResult[$key]['question'] = $result->question;
        }
        return $arrResult;

    }
    /**
     * This function get answers of question
     *
     * @param $lang
     * @param $chapterId
     * @return mixed
     */
    public function getAnswersQuestion($lang, $chapterId)
    {
        $results = DB::table('chapters')
            ->where('chapters.id', $chapterId)
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->join('small_test_questions', 'small_test_questions.small_test_id', 'small_tests.id')
            ->join('small_test_question_choices', 'small_test_question_choices.small_test_question_id', 'small_test_questions.id')
            ->join('languages', 'languages.id', 'small_test_question_choices.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'small_test_question_choices.id as id',
                'small_test_question_choices.choice_no as choice_no',
                'small_test_questions.id as question_id',
                'small_test_question_choices.option_description as description',
                'small_test_question_choices.image_path as image_path',
                'small_test_question_choices.true_or_false as true_or_false'
            )
            ->get();
        $arrResult = [];
        foreach ($results as $key => $result){
            $arrResult[$key]['id'] = $result->id;
            $arrResult[$key]['choice_no'] = $result->choice_no;
            $arrResult[$key]['question_id'] = $result->question_id;
            $arrResult[$key]['description'] = $result->description;
            $arrResult[$key]['image_path'] = $result->image_path ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$result->image_path : '';
            $arrResult[$key]['true_or_false'] = $result->true_or_false;

        }
        return $arrResult;

    }

    /**
     * This function get all question of coma
     * @param $lang
     * @param $chapterId
     * @return array|bool
     */
    public function getQuestion($lang, $chapterId)
    {
        $test_question = SmallTest::where('chapter_id', $chapterId)->get();
//        if ((int)$this->checkContentTypeGradeOfChapterId($chapterId) != Constant::COMA) {
//            return false;
//        } else {
        if(count($test_question)) {
            return array(
                'test_id' => count($test_question) ? $test_question[0]->id : '',
                'chapter_id' => (int)$chapterId,
                'question_format' => count($test_question) ? $test_question[0]->question_format : '',
                'pass_score_rate' => count($test_question) ? $test_question[0]->pass_score_rate : '',
                'option_display_format' => count($test_question) ? $test_question[0]->option_display_format : '',
                'questions' => $this->getQuestionQuestion($lang, $chapterId),
                'answers' => $this->getAnswersQuestion($lang, $chapterId),
            );
        }else{
            return null;
        }
    }

    /**
     * This function get questions of big test
     *
     * @param $lang
     * @param $chapterId
     * @return mixed
     */
    private function getMessagesSmallTest($lang, $chapterId)
    {
        return  DB::table('chapters')
            ->where('chapters.id', $chapterId)
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->join('messages_small_test', 'messages_small_test.small_test_id', 'small_tests.id')
            ->join('languages', 'messages_small_test.language_id','languages.id' )
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
    private function getQuestionsBigTest($lang, $gradeId)
    {
        $small_tests = DB::table('grades')
            ->join('versions',  'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->where('grades.id', $gradeId)
            ->where('versions.published', Constant::PUBLISHED)
            ->select(
                'versions.big_test_id AS test_id',
                'versions.published AS published',
                'grades.id AS grade_id',
                'versions.id AS version_id',
                'chapters.id AS chapter_id',
                'small_tests.id AS small_test_id'
                )
            ->get();
        $arr_small_test_questions = [];
        foreach ($small_tests as $key => $small_test){
            $small_test_question_problems = DB::table('small_test_questions')
                ->join('small_test_question_problems', 'small_test_question_problems.small_test_question_id','small_test_questions.id')
                ->join('languages', 'languages.id','small_test_question_problems.language_id')
                ->where('small_test_questions.small_test_id', $small_test->small_test_id)
                ->where('languages.lang_code', $lang)
                ->inRandomOrder()
                ->limit(2)
                ->select(
                    'small_test_questions.id AS small_test_question_id',
                    'small_test_questions.question_format AS question_format',
                    'small_test_questions.question_no AS question_no',
                    'small_test_question_problems.id AS small_test_question_problem_id',
                    'small_test_questions.title AS title',
                    'small_test_question_problems.image_path AS image_path',
                    'small_test_question_problems.video_path AS video_path',
                    'small_test_question_problems.problem_statement AS problem_statement'
                )
                ->get();
            foreach ($small_test_question_problems as $key2 => $small_test_question_problem){
                $arr_small_test_questions[] = [
                    'test_id'=> $small_test->test_id,
                    'small_test_id' => $small_test->small_test_id,
                    'chapter_id' => $small_test->chapter_id,
                    'small_test_question_id' => $small_test_question_problem->small_test_question_id,
                    'question_format' => $small_test_question_problem->question_format,
                    'question_no' => $small_test_question_problem->question_no,
                    'title' => $small_test_question_problem->title,
                    'id' => $small_test_question_problem->small_test_question_problem_id,
                    'picture_link' => $small_test_question_problem->image_path ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$small_test_question_problem->image_path : '',
                    'video_link' => $small_test_question_problem->video_path ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$small_test_question_problem->video_path: '',
                    'question' => $small_test_question_problem->problem_statement
                ];
            }
        }
        return $arr_small_test_questions;
    }

    /**
     * This function get answers of big test
     *
     * @param $lang
     * @param $gradeId
     * @return mixed
     */
    private function getAnswersBigTest($lang, $gradeId)
    {
        $results = DB::table('versions')
            ->where('versions.published', Constant::PUBLISHED)
            ->join('grades', 'grades.id', 'versions.grade_id')
            ->join('big_tests', 'big_tests.grade_id', 'grades.id')
            ->where('grades.id', $gradeId)
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->join('small_test_questions', 'small_test_questions.small_test_id', 'small_tests.id')
            ->join('small_test_question_choices', 'small_test_question_choices.small_test_question_id', 'small_test_questions.id')
            ->join('languages', 'languages.id', 'small_test_question_choices.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'small_test_questions.id as question_id',
                'small_test_question_choices.id as id',
                'small_test_question_choices.option_description as description',
                'small_test_question_choices.true_or_false as true_or_false',
                'small_test_question_choices.image_path as image_path',
                'small_test_question_choices.choice_no as choice_no'
            )
            ->get();
        $arrResult = [];
        foreach ($results as $key => $result){
            $arrResult[$key]['question_id'] = $result->question_id;
            $arrResult[$key]['id'] = $result->id;
            $arrResult[$key]['description'] = $result->description;
            $arrResult[$key]['true_or_false'] = $result->true_or_false;
            $arrResult[$key]['choice_no'] = $result->choice_no;
            $arrResult[$key]['image_path'] = $result->image_path ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$result->image_path:'';
        }
        return $arrResult;

    }

    /**
     * This function get big test
     *
     * @param $lang
     * @param $gradeId
     * @return array|bool
     */
    public function getBigTest($lang, $gradeId)
    {
        $big_test = BigTest::where('grade_id', $gradeId)->get();
        if ((int)$this->getContentTypeGrade($gradeId) != Constant::COMA) {
            return false;
        } else {
            $result = array(
                'test_id' => count($big_test) ? $big_test[0]->id : '',
//                'question_format' => count($big_test) ? $big_test[0]->question_format : '',
                'questions' => $this->getQuestionsBigTest($lang, $gradeId),
                'answers' => $this->getAnswersBigTest($lang, $gradeId)

            );
            return $result;
        }
    }
    private function getMessagesBigTest($lang, $gradeId){
        return DB::table('grades')
            ->where('grades.id', $gradeId)
            ->join('messages_big_test', 'messages_big_test.grade_id', 'grades.id')
            ->join('languages', 'languages.id', 'messages_big_test.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'messages_big_test.id AS id',
                'messages_big_test.passing_message AS passing_message',
                'messages_big_test.failed_message AS failed_message',
                'messages_big_test.correct_message AS correct_message',
                'messages_big_test.incorrect_message AS incorrect_message'
                )
            ->get();
    }

}