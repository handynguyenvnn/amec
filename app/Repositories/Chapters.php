<?php

namespace App\Repositories;

use App\Models\Chapter;
use App\Models\ChapterName;
use App\Models\Coma;
use App\Models\Grade;
use App\Models\ComaLanguage;
use App\Models\LogChapter;
use App\Models\LogSmallTest;
use App\Models\MessageSmallTest;
use App\Models\SmallTest;
use App\Models\SmallTestQuestion;
use App\Models\Version;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Libs\Constants\Constant;
use Illuminate\Support\Facades\Storage;
use App\Models\Language;
use App\Repositories\Xmls;


/**
 * Class Chapters
 * @package App\Repositories
 */
class Chapters extends Repository
{
    public function __construct()
    {
        parent::__construct(new Chapter());
    }

    public $action = 'chapters';

    public function postHistory($chapterId, $completion_flg, $userId)
    {
        $versionId = Chapter::find($chapterId);
        if (!$versionId) {
            return false;
        }
        $management_number = DB::table('logs_chapter')->max('management_number');
        if ($completion_flg == 1) {
            $management_number = ++$management_number;
        }
        $versionId = $versionId->version_id;
        $relate_version = Version::find($versionId) ? Version::find($versionId)->relate_version : null;
        $logs_chapter = new LogChapter();
        $logs_chapter->chapter_id = $chapterId;
        $logs_chapter->user_id = $userId;
        $logs_chapter->relate_version = $relate_version;
        $logs_chapter->completion_flg = ($completion_flg == 1) ? true : false;
        $logs_chapter->date = date('Y-m-d H:i:s');
        $logs_chapter->management_number = $management_number;
        $logs_chapter->save();
        return $logs_chapter;

    }

    public function get_messages_small_test($grade_id)
    {
        $messages_small_tests = MessageSmallTest::where('grade_id', $grade_id)->get();
        $arr_messages_small_tests = [];
        foreach ($messages_small_tests as $key => $messages_small_test) {
            $lang_code = Language::find($messages_small_test->language_id);
            if (count($lang_code) > 0) {
                $lang_code = $lang_code->lang_code;
                $arr_messages_small_tests[$lang_code . '_id'] = $messages_small_test->id;
                $arr_messages_small_tests[$lang_code . '_passing_message'] = $messages_small_test->passing_message;
                $arr_messages_small_tests[$lang_code . '_failed_message'] = $messages_small_test->failed_message;
                $arr_messages_small_tests[$lang_code . '_correct_message'] = $messages_small_test->correct_message;
                $arr_messages_small_tests[$lang_code . '_incorrect_message'] = $messages_small_test->incorrect_message;
            }
        }
        return $arr_messages_small_tests;
    }

    /**
     * @param array $params
     * @param null $versionId
     * @return mixed
     */

    public function search(array $params, $versionId = null)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';
        $this->query = DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->join('languages', 'chapter_names.language_id', 'languages.id')
            ->where('chapter_names.language_id', Constant::LANG_JA_ID)
            ->select(
                'grades.id AS grade_id',
                'chapters.id AS id',
                'chapters.chapter_no',
                'chapter_names.name AS name',
                'small_tests.id AS small_test_id',
                'languages.lang as lang', 'chapter_names.language_id as language_id')
            ->orderBy('chapters.chapter_no');
        if ($versionId && intval($versionId) > 0) {
            $this->query = $this->query->where('versions.id', $versionId);
        }
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['chapter_name'])) {
            $this->query->where('chapter_name', 'LIKE', '%' . $params['chapter_name'] . '%');
        }
        if (isset($params['language'])) {
            $this->query->where('language', 'LIKE', '%' . $params['language'] . '%');
        }
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    public function searchByGrade(array $params, $gradeId)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';
        $this->query = DB::table('grades')
            ->where('grades.id', $gradeId)
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->join('small_tests', 'small_tests.chapter_id', 'chapters.id')
            ->join('languages', 'chapter_names.language_id', 'languages.id')
            ->select(
                'chapters.id AS id', 'chapter_names.name AS name',
                'small_tests.id AS small_test_id',
                'languages.lang as lang', 'chapter_names.language_id as language_id');
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['chapter_name'])) {
            $this->query->where('chapter_name', 'LIKE', '%' . $params['chapter_name'] . '%');
        }
        if (isset($params['language'])) {
            $this->query->where('language', 'LIKE', '%' . $params['language'] . '%');
        }
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    public function searchChapterByGradeId($gradeId)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';
        $this->query = DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->where('versions.grade_id', $gradeId)
            ->select(
                'versions.id AS id',
                'versions.name AS version_name',
                'versions.published AS version_published',
                'versions.version_no AS version_no'
                )
            ->orderBy('versions.version_no', 'ASC')
            ->orderBy('versions.id', 'DESC')
        ;
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    /**
     * @param $chapterId
     * @param $input
     * @param $file
     */
    public function createComa($chapterId, $input, $file, $languages = null)
    {
        $coma = new Coma();
        $coma->chapter_id = $chapterId;
        $coma->frame_name = $input['name_chapter_coma'];
        $coma->frame_no = rand(10, 99);
        $coma->coma_category_id = $input['coma_category_id'];
        $coma->folder_id = str_random(10);
        $coma->file_id = str_random(10);
        $coma->control_no = str_random(10);
        $coma->save();

        $xmls = new Xmls();
        $xmls->resetFieldNo('comas', 'frame_no', "chapter_id=" . $chapterId);

        if ($languages) {
            foreach ($languages AS $lang) {
                $langCode = $lang->lang_code;
                if (isset($input["{$langCode}_description"])) {
                    $this->createComaLanguage($coma->id, $lang->id, $input["{$langCode}_description"], $file["{$langCode}_image_path"]);
                }
            }
        }
    }

    public function updateComa($chapterId = null, $input = null, $request = null, $languages = null)
    {
        if ($input['id_chapter_coma'] == null) {
            $coma = new Coma();
            $coma->frame_no = intval(DB::table('comas')->where('chapter_id', $chapterId)->max('frame_no')) + 1;
        } else {
            $coma = Coma::find($input['id_chapter_coma']);
        }
        $coma->chapter_id = $chapterId;
        $coma->frame_name = $input['name_chapter_coma'];
        $coma->coma_category_id = $input['coma_category_id'];
        $coma->folder_id = str_random(10);
        $coma->file_id = str_random(10);
        $coma->control_no = str_random(10);
        $coma->save();
        if ($languages) {
            foreach ($languages AS $el) {
                $code = $el->lang_code;
                if (isset($input["{$code}_description"])) {
                    $checkbox = isset($input["{$code}_checkbox"]) ? $input["{$code}_checkbox"] : null;

                    $this->updateComaLanguage($input["{$code}_coma_language_id"], $coma->id, $el->id, $input["{$code}_description"], $request["{$code}_image_path"], $request["{$code}_audio_path"], $request["{$code}_video_path"], $checkbox);
                }
            }
        }
    }

    /**
     * @param null $input
     * @param null $language_id
     * @param null $coma_id
     */
    public function updateComaLanguage($input = null, $language_id = null, $coma_id = null)
    {
        $year = date('Y');
        $month = date('m');
        if (isset($input['id'])) {
            $coma_language = ComaLanguage::find($input['id']);
        } else {
            $coma_language = new ComaLanguage();
        }
        $coma_language->coma_id = $coma_id;
        $coma_language->language_id = $language_id;
        $coma_language->description = isset($input['description']) ? $input['description'] : '';
        $priority_check = 0;
        if (isset($input['priority_check']) && $input['priority_check'] == 'on') {
            $priority_check = 1;
        }
        $coma_language->priority_check = $priority_check;
        $coma_language->file_id = str_random(10);
        if (isset($input['image_path'])) {
            $image = $input['image_path'];
            $nameImage = str_random(15) . pathinfo($image)['filename'];
            $extImage = $image->guessClientExtension();
            if (Storage::disk('s3')->putFileAs('image/comas/'.$year.DS.$month, $image, "{$nameImage}.{$extImage}", "public")) {
                $coma_language->image_path = 'image/comas/'.$year.DS.$month . DS . $nameImage . '.' . $extImage;
            } else {
                $coma_language->image_path = Constant::NO_IMAGE;
            }
        }
        if (isset($input['audio_path'])) {
            $music = $input['audio_path'];
            $nameMusic = str_random(15) . pathinfo($music)['filename'];
//            $extMusic = $music->guessClientExtension();
            $extMusic = 'mp3';
            if (Storage::disk('s3')->putFileAs('audio/comas/'.$year.DS.$month, $music, "{$nameMusic}.{$extMusic}", "public")) {
                $coma_language->music_path = 'audio/comas/' .$year.DS.$month. DS . $nameMusic . '.' . $extMusic;
            } else {
                $coma_language->music_path = Constant::NO_MUSIC;
            }
        }
        if (isset($input['video_path'])) {
            $video = $input['video_path'];
            $nameVideo = str_random(15) . pathinfo($video)['filename'];
            $extVideo = $video->guessClientExtension();
            if (Storage::disk('s3')->putFileAs('video/comas/'.$year.DS.$month, $video, "{$nameVideo}.{$extVideo}", "public")) {
                $coma_language->video_path = 'video/comas/'.$year.DS.$month . DS . $nameVideo . '.' . $extVideo;
            } else {
                $coma_language->video_path = Constant::NO_VIDEO;
            }
        }
        $coma_language->save();
    }

    /**
     * @param $chapterId
     * @return mixed
     */
    public function searchChapterNameByChapterId($chapterId)
    {
        $arr_chapter = array();
        $chapters = DB::table('chapters')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->where('chapters.id', $chapterId)
            ->select(
                'chapter_names.id AS id',
                'chapter_names.name AS name',
                'chapter_names.language_id AS language_id'
            )
            ->get();
        foreach ($chapters as $key => $chapter) {
            $arr_chapter[$chapter->language_id]['id'] = $chapter->id;
            $arr_chapter[$chapter->language_id]['name'] = $chapter->name;
            $arr_chapter[$chapter->language_id]['language_id'] = $chapter->language_id;
            $arr_chapter[$chapter->language_id]['lang'] = Language::find($chapter->language_id)->lang;
        }
        return $arr_chapter;
    }

    public function searchComaByChapterId($chapterId= null, $coma_name = null)
    {
        $languages = Language::all();
        $arr_coma = array();
        if($coma_name && $coma_name!=''){
            $comas = DB::table('chapters')
                ->join('comas', 'comas.chapter_id', 'chapters.id')
                ->where('chapters.id', $chapterId)
                ->where('comas.frame_name','like', '%'. $coma_name. '%')
                ->select(
                    'comas.id AS id',
                    'chapters.id AS chapter_id',
                    'comas.frame_name AS frame_name',
                    'comas.frame_no',
                    'comas.coma_category_id')
                ->orderBy('comas.frame_no', 'ASC')
                ->orderBy('comas.id', 'DESC')
                ->get();
        }else {
            $comas = DB::table('chapters')
                ->join('comas', 'comas.chapter_id', 'chapters.id')
                ->where('chapters.id', $chapterId)
                ->select(
                    'comas.id AS id',
                    'chapters.id AS chapter_id',
                    'comas.frame_name AS frame_name',
                    'comas.frame_no',
                    'comas.coma_category_id')
                ->orderBy('comas.frame_no', 'ASC')
                ->orderBy('comas.id', 'DESC')
                ->get();
        }
        foreach ($comas as $key => $coma) {
            $arr_coma[$key]['id'] = $coma->id;
            $arr_coma[$key]['frame_name'] = $coma->frame_name;
            $arr_coma[$key]['frame_no'] = $coma->frame_no;
            $arr_coma[$key]['category_id'] = $coma->coma_category_id;
            $coma_languages = DB::table('coma_languages')
                ->where('coma_languages.coma_id', $coma->id)
                ->get();
            foreach ($coma_languages as $key_coma => $coma_language) {
                $arr_coma[$key]['coma_languages'][$coma_language->language_id]['id'] = $coma_language->id;
                $arr_coma[$key]['coma_languages'][$coma_language->language_id]['image_path'] = $coma_language->image_path;
                $arr_coma[$key]['coma_languages'][$coma_language->language_id]['music_path'] = $coma_language->music_path;
                $arr_coma[$key]['coma_languages'][$coma_language->language_id]['description'] = $coma_language->description;
                $arr_coma[$key]['coma_languages'][$coma_language->language_id]['language_id'] = $coma_language->language_id;
                $arr_coma[$key]['coma_languages'][$coma_language->language_id]['video_path'] = $coma_language->video_path;
                $arr_coma[$key]['coma_languages'][$coma_language->language_id]['priority_check'] = $coma_language->priority_check;
            }
        }
        $total = count($arr_coma);
        foreach ($languages as $k => $language) {
            $arr_coma[$total]['coma_languages'][$language->id] = array();
        }
        return $arr_coma;
    }

    /**
     * @param $id
     * @return array
     */
    public function searchById($id, $languages = null)
    {
        $this->query = DB::table('chapters')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->join('languages', 'chapter_names.language_id', 'languages.id')
            ->where('chapters.id', $id)
            ->select(
                'chapter_names.name AS name',
                'languages.lang_code AS lang_code',
                'chapter_names.id AS chapter_name_id',
                'chapter_names.language_id AS language_id')
            ->get();

        $arrayResult = array();
        $arrayResult['id'] = $id;
        foreach ($this->query as $item) {
            $langCode = $item->lang_code;
            $arrayResult["{$langCode}_name"] = $item->name;
            $arrayResult["{$langCode}_chapter_name_id"] = $item->chapter_name_id;
        }
        return $this->query = $arrayResult;
    }

    /**
     * @param $input
     */
    public function createChapter(array $input, $file, $languages, $versionId)
    {

        $chapter = new Chapter();
        $chapter->version_id = $versionId;
        $chapter->chapter_no = null;
        $chapter->control_no = str_random(10);
        $chapter->folder_id = str_random(10);
        $chapter->file_id = str_random(10);

        $chapter->save();

        $this->createSmallTest($chapter->id);
        $this->createComa($chapter->id, $input, $file, $languages);
        if ($languages) {
            foreach ($languages AS $lang) {
                $langCode = $lang->lang_code;
                if (isset($input["{$langCode}_name"])) {
                    $this->createChapterName($chapter->id, $lang->id, $input["{$langCode}_name"]);
                }
            }
        }
    }

    public
    function createSmallTest($chapterId)
    {
        $smallTest = new SmallTest();
        $smallTest->chapter_id = $chapterId;
        $smallTest->save();
    }

    /**
     * @param $chapterId
     * @param $langId
     * @param $name
     */
    public
    function createChapterName($chapterId, $langId, $name)
    {
        $chapterName = new ChapterName();
        $chapterName->chapter_id = $chapterId;
        $chapterName->language_id = $langId;
        $chapterName->name = $name;
        $chapterName->file_id = str_random(10);
        $chapterName->save();
    }

    /**
     * @param $id
     * @param $input
     * @param $request
     * @param $languages
     * @return null
     */
    public function updateChapter($id = null, $input = null, $request = null, $languages = null)
    {
        $chapter = null;
        if ($id == null) {
            $chapter = new Chapter();
        } else {
            $chapter = Chapter::find($id);
        }


        if (empty($input['version_id'])) {
            $versions = new Versions();
            $chapter->version_id = $versions->createVersion($input['grade_id'], '');
        } else {
            $chapter->version_id = $input['version_id'];
        }
        $chapter->chapter_no = null;
        $chapter->control_no = str_random(10);
        $chapter->folder_id = str_random(10);
        $chapter->file_id = str_random(10);
        $chapter->save();
        $id = $chapter->id;

        $xmls = new Xmls();
        $xmls->resetFieldNo('versions', 'version_no', "grade_id=" . $input['grade_id']);
        $xmls->resetFieldNo('chapters', 'chapter_no', "version_id=" . $input['version_id']);

        $findSmallTest = SmallTest::where('chapter_id', $id)->get();
        if (!(count($findSmallTest) > 0)) {
            $smallTest = new SmallTest();
            $smallTest->chapter_id = $id;
            $smallTest->save();
        }
        if (isset($input['chapter_names']) && count($input['chapter_names']) > 0) {
            $chapter_names = $input['chapter_names'];
            DB::table('chapter_names')->where('chapter_id', $id)->delete();
            foreach ($chapter_names as $key => $chapter_name) {
                $update_chapter_name = new ChapterName();
                $update_chapter_name->language_id = $key;
                $update_chapter_name->chapter_id = $id;
                $update_chapter_name->name = $chapter_name ;
                $update_chapter_name->save();
            }
        }
        if (isset($input['comas']) && count($input['comas']) > 0) {
            $comas = $input['comas'];
            foreach ($comas as $coma) {
                if (isset($coma['id'])) {
                    $update_coma = Coma::find($coma['id']);
                    if (count($update_coma) > 0) {
                        $update_coma->frame_name = isset($coma['name']) ? $coma['name'] : '';
                        $update_coma->coma_category_id = isset($coma['category_id']) ? $coma['category_id'] : 1;
                        $update_coma->save();
                    } else {
                        $update_coma = new Coma();
                        $update_coma->id = $coma['id'];
                        $update_coma->frame_name = isset($coma['name']) ? $coma['name'] : '';
                        $update_coma->coma_category_id = isset($coma['category_id']) ? $coma['category_id'] : 1;
                        $update_coma->save();
                    }
                } else {
                    $update_coma = new ChapterName();
                    $update_coma->frame_name = isset($coma['name']) ? $coma['name'] : '';
                    $update_coma->coma_category_id = isset($coma['category_id']) ? $coma['category_id'] : 1;
                    $update_coma->save();
                }
                if (isset($coma['coma_languages']) && count($coma['coma_languages']) > 0) {
                    $coma_languages = $coma['coma_languages'];
                    foreach ($coma_languages as $key => $coma_language) {
                        $this->updateComaLanguage($coma_language, $key, $update_coma->id);
                    }
                }
            }
        }
        if(isset($input['addcomas'])){
            $coma = $input['addcomas'];
            if(isset($coma['name']) && $coma['name'] != '') {
                $coma_new = new Coma();
                $coma_new->chapter_id = $id;
                $coma_new->frame_name = isset($coma['name']) ? $coma['name'] : '';
                $coma_new->frame_no = DB::table('comas')->max('frame_no') + 1;
                $coma_new->coma_category_id = isset($coma['category_id']) ? $coma['category_id'] : 1;
                $coma_new->save();
                if (isset($coma['coma_languages'])) {
                    $coma_languages = $coma['coma_languages'];
                    foreach ($coma_languages as $key => $coma_language) {
                        $this->updateComaLanguage($coma_language, $key, $coma_new->id);
                    }
                }
            }
        }
        if ($id) {
            $xmls->resetFieldNo('comas', 'frame_no', "chapter_id=" . $id);
        }
    }

    /**
     * @param $chapterId
     * @param $langId
     * @param $name
     */
    public function updateChapterName($id, $chapterId, $langId, $name)
    {
        if ($id) {
            $chapterName = ChapterName::find($id);
        } else {
            $chapterName = new ChapterName();
        }
        $chapterName->chapter_id = $chapterId;
        $chapterName->language_id = $langId;
        $chapterName->name = $name;
        $chapterName->file_id = str_random(10);
        $chapterName->save();
    }

    public
    function getChapter($lang, $userId)
    {
        return array(
            'chapter' => $this->getChapterComa($lang, $userId)
        );
    }

    protected
    function getContentTypeGrade($gradeId)
    {
        $checkType = DB::table('grades')
            ->where('grades.id', $gradeId)
            ->select('grades.content_type as content_type')
            ->first();
        if (count($checkType) > 0)
            return $checkType->content_type;
        else
            return false;
    }

    private
    function getChapterComa($lang, $userId)
    {
        $result = DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->where('versions.published', Constant::PUBLISHED)
            ->join('chapters', 'chapters.version_id', 'versions.id')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->join('languages', 'languages.id', 'chapter_names.language_id')
            ->where('languages.lang_code', $lang)
            ->where('chapter_names.name', '!=', '')
            ->select(
                'grades.id AS grade_id',
                'chapter_names.name AS name',
                'chapters.id AS id',
                'chapters.chapter_no AS chapter_no',
                'chapters.version_id AS version_id',
                'chapters.updated_at AS date'
            )
            ->get();
        $arrChapter = [];
        foreach ($result as $key => $temp) {
            $arrChapter[$key]['grade_id'] = $temp->grade_id;
            $arrChapter[$key]['name'] = $temp->name;
            $arrChapter[$key]['id'] = $temp->id;
            $arrChapter[$key]['chapter_no'] = !empty($temp->chapter_no) ? $temp->chapter_no : 0;
            $arrChapter[$key]['version_id'] = $temp->version_id;
            $arrChapter[$key]['date'] = $temp->date;
            $arrChapter[$key]['status'] = $this->checkStatusChapter($temp->id, $userId)['status'];
            $arrChapter[$key]['updated_at_log_small_test'] = $this->checkStatusChapter($temp->id, $userId)['updated_at'];
        }
        return $arrChapter;

    }

    private function checkStatusChapter($id = null, $userId = null)
    {
        $status = Constant::STATUS_NO_TEST;
        $updated_at = null;
        $small_tests = SmallTest::where('chapter_id', $id)->first();
        if (count($small_tests) > 0) {
            $logs_small_test = LogSmallTest::where('user_id', $userId)
                ->where('small_test_id', $small_tests->id)
                ->orderBy('point', 'desc')
                ->first();
            if (count($logs_small_test) > 0) {
                if ($logs_small_test->result == 1) {
                    $status = Constant::STATUS_TEST_PASS;
                    $updated_at = $logs_small_test->updated_at;
                    return array(
                        'status' => $status,
                        'updated_at' => date('Y-m-d h:i:s', strtotime($updated_at)),
                    );
                } else {
                    $status = Constant::STATUS_TEST_NO_PASS;
                    return array(
                        'status' => $status,
                        'updated_at' => $updated_at,
                    );
                }
            } else {
                return array(
                    'status' => $status,
                    'updated_at' => $updated_at,
                );
            }


        } else {
            return $status;
        }
    }

    private
    function getComaComa($lang)
    {
        $result = DB::table('grades')
            ->join('versions', 'versions.grade_id', '=', 'grades.id')
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
                'comas.coma_category_id as coma_category_id',
                'coma_languages.music_path as music_link',
                'coma_languages.image_path as picture_link',
                'coma_languages.video_path as video_link',
                'coma_languages.description as description'
            )
            ->get();
        return $result;
    }

    private
    function getGradeComa($id)
    {
        $result = Grade::where('id', $id)->select('id', 'updated_at as date')->get();
        return $result;
    }

    public function fetchALl($languageId)
    {
        return DB::table('chapters')
            ->join('chapter_names', 'chapter_names.chapter_id', 'chapters.id')
            ->where('chapter_names.language_id', $languageId)
            ->select(
                'chapters.id AS id',
                'chapters.version_id AS version_id',
                'chapters.control_no AS control_no',
                'chapters.collection_id AS collection_id',
                'chapters.chapter_no AS chapter_no',
                'chapters.folder_id AS folder_id',
                'chapters.file_id AS file_id',
                'chapters.tag AS tag',
                'chapters.management_numbers AS management_numbers',
                'chapter_names.id AS chapter_name_id',
                'chapter_names.chapter_id AS chapter_id',
                'chapter_names.language_id AS language_id',
                'chapter_names.name AS name',
                'chapter_names.file_id AS file_id'
            )
            ->get();
    }

    public function processExportXML($languageId)
    {
        $lang = count(Language::find($languageId)) > 0 ? Language::find($languageId)->lang_code : '';
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' . '<共通 lang="' . $lang . '" />');
        $chapters = Chapter::all();
        if (count($chapters) > 0) {
            foreach ($chapters as $key_chap => $v_chapters) {
                $v_chapter_names = ChapterName::where('chapter_id', $v_chapters->id)
                    ->where('language_id', $languageId)->first();
                if (count($v_chapter_names) > 0) {
                    $chapter = $xml->addChild('チャプター' . ++$key_chap);
                    $chapter->addChild('チャプター名', $v_chapter_names->name);
                }
                $comas = Coma::where('chapter_id', $v_chapters->id)->get();
                foreach ($comas as $key_com => $v_coma) {
                    $coma = $chapter->addChild('コマ' . ++$key_com);
                    $coma_languages = ComaLanguage::where('coma_id', $v_coma->id)
                        ->where('language_id', $languageId)->first();
                    if (count($coma_languages) > 0) {
                        $coma_image = $coma->addChild('画像', $coma_languages->image_path);
                        $coma_video = $coma->addChild('動画', $coma_languages->video_path);
                        if ($coma_languages->priority_check == 0) {
                            $priority_check = 'false';
                        } else {
                            $priority_check = 'true';
                        }
                        $coma_image->attributes('優先チェック', $priority_check);
                        $coma_video->attributes('優先チェック', $priority_check);
                        $coma->addChild('音楽', $coma_languages->music_path);
                        $coma->addChild('説明', $coma_languages->description);
                    }

                }
                $small_tests = SmallTest::where('chapter_id', $v_chapters->id)->first();
                if (count($small_tests) > 0) {
                    $messages_small_test = MessageSmallTest::where('small_test_id', $small_tests->id)
                        ->where('language_id', $languageId)
                        ->first();
                    if (count($messages_small_test) > 0) {
                        $chapter->addChild('合格メッセージ', $messages_small_test->passing_message);
                        $chapter->addChild('不合格メッセージ', $messages_small_test->failed_message);
                        $chapter->addChild('正解メッセージ', $messages_small_test->correct_message);
                        $chapter->addChild('不正解メッセージ', $messages_small_test->correct_message);
                    }
                    $small_test_questions = SmallTestQuestion::where('small_test_id', $small_tests->id)->get();
                    foreach ($small_test_questions as $key_stq => $v_small_test_question) {
                        $small_test_problem = $chapter->addChild('小テスト問題' . ++$key_stq);
                        $small_test_problems = SmallTestQuestionProblem::where('small_test_question_id', $v_small_test_question->id)
                            ->where('language_id', $languageId)
                            ->first();
                        if (count($small_test_problems) > 0) {
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
        }
        return $xml->asXML();
    }

    public function processImportXML($inputs)
    {
//        DB::table('chapters')->truncate();
//        DB::table('chapter_names')->where('chapter_names.language_id', $inputs['チャプタ'][0]['チャプター名']['@attributes']['language_id'])->truncate();
        foreach ($inputs['チャプタ'] as $key => $temp) {
            $chapter_check_exists = Chapter::find($temp['@attributes']['id']);
            if ($chapter_check_exists == null) {
                $chapters = new Chapter();
                $chapters->id = $temp['@attributes']['id'];
            } else {
                $chapters = Chapter::find($temp['@attributes']['id']);
            }
            $chapters->version_id = (int)$temp['@attributes']['version_id'];
            $chapters->control_no = $temp['@attributes']['control_no'];
            $chapters->collection_id = (int)$temp['@attributes']['collection_id'];
            $chapters->chapter_no = $temp['@attributes']['chapter_no'];
            $chapters->folder_id = $temp['@attributes']['folder_id'];
            $chapters->file_id = $temp['@attributes']['file_id'];
            $chapters->tag = $temp['@attributes']['tag'];
            $chapters->management_numbers = $temp['@attributes']['management_numbers'];
            $chapters->save();

            $chapter_name_check_exists = ChapterName::find($temp['チャプター名']['@attributes']['id']);
            if ($chapter_name_check_exists == null) {
                $chapter_names = new ChapterName();
                $chapter_names->id = $temp['チャプター名']['@attributes']['id'];
            } else {
                $chapter_names = ChapterName::find($temp['チャプター名']['@attributes']['id']);
            }
            $chapter_names->chapter_id = $temp['チャプター名']['@attributes']['chapter_id'];
            $chapter_names->language_id = $temp['チャプター名']['@attributes']['language_id'];;
            $chapter_names->name = $temp['チャプター名']['@attributes']['name'];
            $chapter_names->file_id = $temp['チャプター名']['@attributes']['file_id'];
            $chapter_names->save();
        }
    }
}