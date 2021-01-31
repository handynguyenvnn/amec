<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Models\Chapter;
use App\Models\Grade;
use App\Libs\ApiCheckDate\CheckDate;
use Illuminate\Support\Facades\DB;
use App\Libs\Constants\Constant;

/**
 * This class manage all function of Tutorials
 * Class Tutorials
 * @package App\Repositories
 */
class Tutorials extends Repository
{
    public function __construct()
    {
        parent::__construct(new Chapter());
    }

    /**
     * This function get chapter of tutorial
     *
     * @param $lang
     * @return mixed
     */
    private function getChapterTutorial($lang)
    {
        $result = DB::table('grades')
            ->where('grades.content_type', Constant::CONTENT_TYPE_GRADE_IS_TUTORIAL)
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->join('languages', 'languages.id', 'chapter_names.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'chapter_names.name as name',
                'chapters.id AS id',
                'chapters.version_id AS version_id',
                'chapters.chapter_no AS chapter_no',
                'chapters.updated_at AS date'
            )
            ->get();
        $arrChapter = [];
        foreach ($result as $key => $temp)
        {
            $arrChapter[$key]['name'] = $temp->name;
            $arrChapter[$key]['id'] = $temp->id;
            $arrChapter[$key]['version_id'] = $temp->version_id;
            $arrChapter[$key]['chapter_no'] = $temp->chapter_no;
            $arrChapter[$key]['date'] = $temp->date;
            $arrChapter[$key]['status'] = 0;
        }
        return $arrChapter;

    }

    /**
     * This function get coma of tutorial
     *
     * @param $lang
     * @return mixed
     */
    private function getComaTutorial($lang)
    {
        $results = DB::table('grades')
            ->where('grades.content_type', Constant::CONTENT_TYPE_GRADE_IS_TUTORIAL)
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('comas', 'comas.chapter_id', 'chapters.id')
            ->join('coma_categories', 'comas.coma_category_id', 'coma_categories.id')
            ->join('coma_languages', 'coma_languages.coma_id', 'comas.id')
            ->join('languages', 'languages.id', 'coma_languages.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'chapters.id as chapter_id',
                'comas.frame_name as name',
                'comas.frame_no as frame_no',
                'comas.id as id',
                'comas.updated_at as date',
                'coma_languages.music_path as music_link',
                'coma_categories.coma_category_no as coma_category_no',
                'coma_languages.image_path as picture_link',
                'coma_languages.video_path as video_link',
                'coma_languages.description as description')
            ->get();
        $arrResult = [];
        foreach ($results as $key => $result){
            $arrResult[$key]['chapter_id'] = $result->chapter_id;
            $arrResult[$key]['name'] = $result->name;
            $arrResult[$key]['frame_no'] = $result->frame_no;
            $arrResult[$key]['id'] = $result->id;
            $arrResult[$key]['date'] = $result->date;
            $arrResult[$key]['music_link'] = $result->music_link ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$result->music_link : '';
            $arrResult[$key]['coma_category_no'] = $result->coma_category_no;
            $arrResult[$key]['picture_link'] = $result->picture_link ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$result->picture_link : '';
            $arrResult[$key]['description'] = $result->description;
            $arrResult[$key]['video_link'] = $result->video_link ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$result->video_link : '';
        }
        return $arrResult;

    }

    /**
     * This function get grade of tutorial
     *
     * @param $lang
     * @return mixed
     */
    private function getGradeTutorial($lang)
    {
        $result = DB::table('grades')
            ->where('grades.content_type', Constant::CONTENT_TYPE_GRADE_IS_TUTORIAL)
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->where('versions.published', Constant::PUBLISHED)
            ->join('grade_names', 'grade_names.grade_id', '=', 'grades.id')
            ->join('languages', 'languages.id', '=', 'grade_names.language_id')
            ->where('languages.lang_code', $lang)
            ->select('grades.id as id', 'grade_names.id as grade_name_id', 'versions.release_date_chapter as release_date_chapter', 'grade_names.name as title')
            ->get();
        return $result;

    }

    /**
     * @param $date
     * @param $firstTime
     * @param $lang
     * @return array|null
     */
    public function getTutorial($date, $firstTime, $lang)
    {
        $release_date_chapter= DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->where('grades.content_type', Constant::CONTENT_TYPE_GRADE_IS_TUTORIAL)
            ->where('versions.published', Constant::PUBLISHED)
            ->get();
        if(count($release_date_chapter)>0){
            $release_date_chapter= $release_date_chapter[0]->release_date_chapter;
            $gradeUpdatedTime = strtotime($release_date_chapter);
            $date = strtotime($date);
            if (($firstTime == Constant::FIRST_TIME_TRUE) || CheckDate::compareTwoTimes($date, $gradeUpdatedTime)) {
                return array(
                    'chapter' => $this->getChapterTutorial($lang),
                    'coma' => $this->getComaTutorial($lang),
                    'grade' => $this->getGradeTutorial($lang)
                );
            }
            if (($firstTime == Constant::FIRST_TIME_FALSE) && !CheckDate::compareTwoTimes($date, $gradeUpdatedTime)) {
                return null;
            }
        }else{
            return null;
        }
    }

    /**
     * This function get question of question
     *
     * @param $lang , $chapterId
     * @return mixed
     */
    private function getQuestionQuestion($lang, $chapterId)
    {
        $result = DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->where('chapters.id', '=', $chapterId)
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->join('small_test_questions', 'small_test_questions.small_test_id','small_tests.id')
            ->join('small_test_question_problems', 'small_test_question_problems.small_test_question_id', '=', 'small_test_questions.id')
            ->join('languages', 'languages.id', 'small_test_question_problems.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'small_tests.id AS test_id',
                'small_test_questions.title as title',
                'small_tests.chapter_id as chapter_id',
                'small_test_questions.id as small_test_question_id',
                'small_test_questions.question_format as question_format',
                'small_test_questions.question_no as question_no',
                'small_test_question_problems.id as small_test_question_problem_id ',
                'small_test_question_problems.image_path as picture_link',
                'small_test_question_problems.problem_statement as question')
            ->get();
        return $result;

    }

    /**
     * This function get answer of question
     * @param $lang , $chapterId
     * @return mixed
     */
    private function getAnswersQuestion($lang, $chapterId)
    {
        $result = DB::table('grades')
            ->where('grades.content_type', Constant::CONTENT_TYPE_GRADE_IS_TUTORIAL)
            ->join('versions', 'versions.grade_id', '=', 'grades.id')
            ->join('chapters', 'chapters.version_id', '=', 'versions.id')
            ->where('chapters.id', '=', $chapterId)
            ->join('small_tests', 'small_tests.chapter_id', '=', 'chapters.id')
            ->join('small_test_questions', 'small_test_questions.small_test_id', '=', 'small_tests.id')
            ->join('small_test_question_choices', 'small_test_question_choices.small_test_question_id', '=', 'small_test_questions.id')
            ->join('languages', 'languages.id', '=', 'small_test_question_choices.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'small_test_question_choices.id as id',
                'small_test_questions.id as question_id',
                'small_test_question_choices.choice_no as choice_no',
                'small_test_question_choices.option_description as description',
                'small_test_question_choices.option_value as correct'
            )
            ->get();
        return $result;

    }

    /**
     * Function get all question of Tutorial
     *
     * @param $lang ,$chapterId
     * @return array
     */
    public function getQuestion($lang, $chapterId)
    {
        $test_id = DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->where('chapters.id', $chapterId)
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->select(
                'small_tests.id AS test_id', 'question_format')->first();

        $result = array(
            'test_id' => count($test_id)>0 ? $test_id->test_id : '',
            'question_format' => count($test_id)>0 ? $test_id->question_format : '',
            'questions' => $this->getQuestionQuestion($lang, $chapterId),
            'answers' => $this->getAnswersQuestion($lang, $chapterId)
        );
        return $result;
    }
}