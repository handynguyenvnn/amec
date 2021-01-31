<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Tips as _Tips;
use App\Models\MessageTips;
use Illuminate\Support\Facades\Session;
use App\Repositories\Chapters;
use App\Models\Grade;
use App\Models\Version;
use App\Libs\ApiCheckDate\CheckDate;
use App\Libs\Constants\Constant;
use Illuminate\Support\Facades\DB;

/**
 * This class manage all function of Tips
 * Class Tips
 * @package App\Repositories
 */
class Tips extends Repository
{
    /**
     * Tips constructor.
     */
    public function __construct()
    {
        parent::__construct(new _Tips());
    }

    public $action = 'tips';

    /**
     * @param array $params
     * @return mixed
     */
    public function search(array $params)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';
        $this->query = DB::table('tips')
            ->join('versions', 'versions.tips_id', 'tips.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->join('languages', 'chapter_names.language_id', 'languages.id')
            ->select(
                'chapters.id AS id', 'versions.id as version_id',
                'tips.has_small_test as has_small_test',
                'chapter_names.name AS name', 'versions.name AS version_name',
                'languages.lang as lang', 'chapter_names.language_id as language_id');

        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['name'])) {
            $this->query->where('chapter_names.name', 'LIKE', '%' . $params['name'] . '%');
        }
        if (isset($params['version'])) {
            $this->query->where('versions.name', 'LIKE', '%' . $params['version'] . '%');
        }
        if (isset($params['language_id'])) {
            $this->query->where('chapter_names.language_id', $params['language_id']);

        }
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    /**
     * @param array $input
     * @param $chapter
     */
    public function createTips(array $input, $chapter)
    {
        $tip = new _Tips();
        $tip->project_id = $input['project_id'];
        $tip->has_small_test = $input['has_small_test'];
        $tip->control_no = $input['control_no'];
        $tip->folder_id = $input['folder_id'];
        $tip->file_id = $input['file_id'];
        $tip->total_number_of_students = 0;
        $tip->save();
        $this->createVersion($tip->id, $input, $chapter);
    }

    /**
     * @param $tipId
     * @param array $input
     * @param $chapter
     */
    public function createVersion($tipId, array $input, $chapter)
    {
        $version = new Version();
        $version->grade_id = 0;
        $version->tips_id = $tipId;
        $version->name = $input['version_name'];
        $version->release_date_chapter = date('Y-m-d h:i:s');
        $version->chapter_collection_id = 0;
        $version->big_test_id = 0;
        $version->folder_id_version = str_random(10);
        $version->file_id_version = str_random(10);
        $version->file_id_release = str_random(10);
        $version->save();
        $chapter->createChapter(
            array(
                'version_id' => $version->id,
                'collection_id' => $input['collection_id'],
                'ja_name' => $input['ja_name'],
                'en_name' => $input['en_name'],
                'vn_name' => $input['vn_name']
            )
        );
    }

    /**
     * This function get all chapters of coma
     * @param $lang
     * @return mixed
     */
    private function getChapterComa($lang)
    {
        $result = DB::table('tips')
            ->join('versions', 'versions.tips_id', '=', 'tips.id')
            ->join('chapters', 'chapters.version_id', '=', 'versions.id')
            ->join('chapter_names', 'chapter_names.chapter_id', '=', 'chapters.id')
            ->join('languages', 'languages.id', '=', 'chapter_names.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'chapter_names.name as name',
                'chapters.id as id',
                'chapters.version_id as version_id',
                'chapters.updated_at as date')
            ->get();
        return $result;

    }

    /**
     * This function get all comas of coma
     *
     * @param $lang
     * @return mixed
     */
    private function getComaComa($lang)
    {
        $result = DB::table('tips')
            ->join('versions', 'versions.tips_id', '=', 'tips.id')
            ->join('chapters', 'chapters.version_id', '=', 'versions.id')
            ->join('comas', 'comas.chapter_id', '=', 'chapters.id')
            ->join('coma_languages', 'coma_languages.coma_id', '=', 'comas.id')
            ->join('languages', 'languages.id', '=', 'coma_languages.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'coma.frame_name as name',
                'coma.id as id',
                'coma.chapter_id as chapter_id',
                'coma.updated_at as date',
                'coma_languages.music_path as music_link',
                'coma_languages.image_animation_path as picture_link',
                'coma_languages.video_path as video_link',
                'coma_languages.description as description')
            ->get();
        return $result;

    }

    /**
     * This function get all coma of Tips
     *
     * @param $lang
     * @return array
     */
    public function getComa($lang)
    {
        $result = array(
            'chapter' => $this->getChapterComa($lang),
            'coma' => $this->getComaComa($lang)
        );
        return $result;
    }

    /**
     * This function get all questions of tips
     *
     * @param $lang
     * @return array
     */
    public function getQuestion($lang)
    {
        $result = DB::table('tips')
            ->join('versions', 'versions.tips_id', '=', 'tips.id')
            ->join('chapters', 'chapters.version_id', '=', 'versions.id')
            ->join('small_tests', 'small_tests.chapter_id', '=', 'chapters.id')
            ->join('small_test_questions', 'small_test_questions.small_test_id', '=', 'small_tests.id')
            ->join('small_test_question_choices', 'small_test_question_choices.small_test_question_id', '=', 'small_test_questions.id')
            ->join('small_test_question_problems', 'small_test_question_problems.small_test_question_id', '=', 'small_test_questions.id')
            ->join('languages', 'languages.id', '=', 'small_test_question_problems.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'small_test_questions.title as title',
                'small_test_questions.id as chapter_id',
                'chapters.id as id',
                'small_test_question_problems.image_path as picture_link',
                'small_test_question_problems.problem_statement as question')
            ->get();
        return $result;
    }
    /**
     * @param $date
     * @param $firstTime
     * @param $lang
     * @return array|null
     */
    public function getTip($date, $firstTime, $lang)
    {
        $gradeUpdatedAt = strtotime(Project::first()->updated_at);
        $date = strtotime($date);
        if (($firstTime == Constant::FIRST_TIME_TRUE) || !CheckDate::compareTwoTimes($date, $gradeUpdatedAt)) {
            return array(
                'chapter' => $this->getChapterTip($lang),
                'coma' => $this->getComaTip($lang),
                'grade' => _Tips::select('id', 'updated_at AS date')->get(),
            );
        }
        if (($firstTime == Constant::FIRST_TIME_FALSE) && CheckDate::compareTwoTimes($date, $gradeUpdatedAt)) {
            return null;
        }
    }

    /**
     * @param $lang
     * @return mixed
     */
    private function getChapterTip($lang)
    {
        $result = DB::table('tips')
            ->join('versions', 'versions.tips_id', 'tips.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->join('languages', 'languages.id', 'chapter_names.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'versions.tips_id AS tips_id',
                'chapter_names.name AS name',
                'chapters.id AS id',
                'chapters.chapter_no AS chapter_no',
                'chapters.version_id AS version_id',
                'chapters.updated_at AS date'
            )
            ->get();
        return $result;

    }

    /**
     * @param $lang
     * @return mixed
     */
    private function getComaTip($lang)
    {
        $result = DB::table('tips')
            ->join('versions', 'versions.tips_id', '=', 'tips.id')
            ->join('chapters', 'chapters.version_id', '=', 'versions.id')
            ->join('comas', 'comas.chapter_id', '=', 'chapters.id')
            ->join('coma_languages', 'coma_languages.coma_id', '=', 'comas.id')
            ->join('languages', 'languages.id', '=', 'coma_languages.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'comas.frame_name as name',
                'comas.id as id',
                'comas.chapter_id as chapter_id',
                'comas.updated_at as date',
                'coma_languages.music_path as music_link',
                'coma_languages.image_path as picture_link',
                'coma_languages.video_path as video_link',
                'coma_languages.description as description'
            )
            ->get();
        return $result;
    }
}