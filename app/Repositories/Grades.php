<?php

namespace App\Repositories;


use App\Libs\Constants\Constant;
use App\Models\BigTest;
use App\Models\Chapter;
use App\Models\ChapterName;
use App\Models\Coma;
use App\Models\ComaLanguage;
use App\Models\Grade;
use App\Models\GradeName;
use App\Models\LogBigTest;
use App\Models\MessageSmallTest;
use App\Models\MessageBigTest;
use App\Models\MyBackgroundPage;
use App\Models\Project;
use App\Models\SmallTest;
use App\Models\SmallTestQuestion;
use App\Models\SmallTestQuestionChoice;
use App\Models\SmallTestQuestionProblem;
use App\Models\Version;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
use App\Libs\ApiCheckDate\CheckDate;
use Illuminate\Support\Facades\Session;
use App\Repositories\Xmls;

/**
 * This class manage all action of Grade
 * Class Grades
 * @package App\Repositories
 */
class Grades extends Repository
{
    public $action = 'grades';

    /**
     * Grades constructor.
     */
    public function __construct()
    {
        parent::__construct(new Grade());
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function search(array $params)
    {
        // Set sort and paginate
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';

        $this->query = DB::table('grades')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->select(
                'grades.id AS id', 'versions.name AS name');
        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['subject'])) {
            $this->query->where('subject', 'LIKE', '%' . $params['subject'] . '%');
        }
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);

        return $this->query->paginate($perPage);
    }

    /**
     * @param $id
     * @return array
     */
    public function getGradeById($id, $languages = null)
    {
        $result = DB::table('grades')
            ->join('grade_names', 'grades.id', 'grade_names.grade_id')
            ->join('languages', 'languages.id', 'grade_names.language_id')
            ->where('grade_names.grade_id', $id)
            ->select('grades.id AS id',
                'languages.lang_code',
                'grades.project_id AS project_id',
                'grades.content_type AS content_type',
                'grade_names.id AS grade_id',
                'grade_names.id AS name_grade_id',
                'grade_names.name AS name',
                'grade_names.language_id AS language_id'
            )
            ->get();
        $arrayResult = array();
        foreach ($result as $temp) {
            $arrayResult['id'] = $id;
            $arrayResult['project_id'] = $temp->project_id;
            $arrayResult['content_type'] = $temp->content_type;

            $code = $temp->lang_code;
            $arrayResult["{$code}_name"] = $temp->name;
            $arrayResult["{$code}_grade_id"] = $temp->grade_id;
            $arrayResult["{$code}_name_grade_id"] = $temp->name_grade_id;
        }
        return $arrayResult;
    }
    public function getGrateNo() {
        return ;
    }

    /**
     * @param array $input
     * @param null $languages
     * @return mixed
     */
    public function createGrade(array $input, $languages = null)
    {
        if (intval($input['id']) > 0) {
            $grade = Grade::find($input['id']);
        } else {
            $grade = new Grade();
        }
        /*$no = DB::table('grades')->max('grade_no');
        $grade->grade_no = isset($input['no']) > 0 ? $input['no'] : (intval($no) + 1);*/
        $grade->content_type = $input['content_type'];
        $grade->folder_id = str_random(10);
        $grade->file_id = str_random(10);
        $grade->save();

        $xml = new Xmls();
        $xml->resetFieldNo();

        // Update pass score rate
        if (!empty($input['pass_score_rate'])) {
            $this->updateBigTest($grade->id, $input['pass_score_rate']);
        }

        if ($languages) {
            foreach ($languages AS $el) {
                $code = $el->lang_code;
                $params = [
                    'grade_id' => $grade->id,
                    'passing_message' => $input["{$code}_passing_message"],
                    'failed_message' => $input["{$code}_failed_message"],
                    'correct_message' => $input["{$code}_correct_message"],
                    'incorrect_message' => $input["{$code}_incorrect_message"]
                ];
                if ($input["{$code}_name"] != '') {
                    $this->createGradeName($params['grade_id'], $el->id, $input["{$code}_name"], 0);
                    $this->createMessageBigTestByLang($el->id, $params, 0, 0);//$bigTestId = 0, $id=0
                }
            }
        }
        return $grade->id;
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
//    public function updateGrade($id, $input, $lang = null, Xmls $xmls)
        public function updateGrade($id, $input, $lang = null)
    {
        $grade = Grade::find($id);
        $grade->content_type = $input['content_type'];
        $grade->save();
//        $xmls->resetFieldNo('grades', 'grade_no');
        // Update pass score rate
        if (!empty($input['pass_score_rate'])) {
            $this->updateBigTest($id, $input['pass_score_rate']);
        }

        if ($lang) {
            foreach ($lang AS $el) {
                $code = $el->lang_code;
                $params = [
                    'grade_id' => $grade->id,
                    'passing_message' => $input["{$code}_passing_message"],
                    'failed_message' => $input["{$code}_failed_message"],
                    'correct_message' => $input["{$code}_correct_message"],
                    'incorrect_message' => $input["{$code}_incorrect_message"]
                ];
                if ($input["{$code}_name"] != '') {
                    $this->createGradeName($params['grade_id'], $el->id, $input["{$code}_name"], $input["{$code}_name_grade_id"]);
                    $this->createMessageBigTestByLang($el->id, $params, $input["{$code}_big_test_id"], $input["{$code}_messages_big_test_id"]);//$bigTestId = 0, $id=0
                }
            }
        }
    }

    /**
     * @param $input
     * @param $_langId
     * @param $_lang
     * @description Save message data in to messages_big_test
     * @author TuyenDD
     */
    public function updateMessagesBigTest($input, $_langId, $_lang)
    {
        $param = $input;
        unset($param['content_type']);
        $param = [];
        $id = $grade_id = 0;
        foreach ($input AS $key => $el) {
            $_key = substr($key, 3);
            $_preKey = substr($key, 0, 2);
            if ($_preKey == $_lang && !in_array($_key, ['name', 'grade_id', 'messages_big_test_id'])) {
                $param[$_key] = $el;
            } elseif ($_key == 'grade_id') {
                $grade_id = $input[$key];
            } elseif ($_key == 'messages_big_test_id') {
                $id = $input[$key];
            }
        }
        if ($id == 0) {
            $mst = new MessageSmallTest();
        } else {
            $mst = MessageSmallTest::find($id);
            $mst->id = $id;
        }
        $mst->grade_id = $grade_id;
        $mst->language_id = $_langId;
        if ($param['big_test_id']) {
            $mst->small_test_id = $param['big_test_id'];
        }
        $mst->passing_message = $param['passing_message'];
        $mst->failed_message = $param['failed_message'];
        $mst->correct_message = $param['correct_message'];
        $mst->incorrect_message = $param['incorrect_message'];
        $mst->save();
    }

    /**
     * @param $id
     * @param $gradeId
     * @param $lang
     * @param $name
     */
    public function updateGradeName($id, $gradeId, $lang, $name)
    {
        if ($id == '') {
            $gradeName = new GradeName();
        } else {
            $gradeName = GradeName::find($id);
        }
        $gradeName->name = $name;
        $gradeName->grade_id = $gradeId;
        $gradeName->language_id = $lang;
        $gradeName->save();
    }

    /**
     * @param $gradeId
     * @param $langId
     * @param $name
     */
    public function createGradeName($gradeId, $langId, $name, $id = 0)
    {
        /*$gradeName = new GradeName();
        $gradeName->grade_id = $gradeId;
        $gradeName->language_id = $langId;
        $gradeName->name = $name;
        $gradeName->file_id = str_random(10);
        $gradeName->save();*/
        if ($id > 0) {
            $gradeName = GradeName::find($id);
        } else {
            $gradeName = new GradeName();
            $gradeName->grade_id = $gradeId;
            $gradeName->language_id = $langId;
            $gradeName->file_id = str_random(10);
        }

        $gradeName->name = $name;
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
    public function createMessageSmallTestByLang($langId, $array, $smallTestId = 0, $id = 0)
    {
        if ($id > 0) {
            $messagesSmallTest = MessageSmallTest::find($id);
            $messagesSmallTest->id = $id;
        } else {
            $messagesSmallTest = new MessageSmallTest();
            $messagesSmallTest->small_test_id = $smallTestId;
            $messagesSmallTest->language_id = $langId;
            $messagesSmallTest->grade_id = $array['grade_id'];
            $messagesSmallTest->file_id = str_random(10);
        }

        $messagesSmallTest->passing_message = $array['passing_message'];
        $messagesSmallTest->failed_message = $array['failed_message'];
        $messagesSmallTest->correct_message = $array['correct_message'];
        $messagesSmallTest->incorrect_message = $array['incorrect_message'];
        if ($array['passing_message'] != '' || $array['failed_message'] != '' || $array['correct_message'] != '' || $array['incorrect_message'] != '') {
            $messagesSmallTest->save();
        }
    }

    /**
     * @param $langId
     * @param $array
     */
    public function createMessageBigTestByLang($langId, $array, $bigTestId = 0, $id = 0)
    {
        if ($id > 0) {
            $messagesBigTest = MessageBigTest::find($id);
            $messagesBigTest->id = $id;
        } else {
            $messagesBigTest = new MessageBigTest();
            $messagesBigTest->big_test_id = $bigTestId;
            $messagesBigTest->language_id = $langId;
            $messagesBigTest->grade_id = $array['grade_id'];
            $messagesBigTest->file_id = str_random(10);
        }

        $messagesBigTest->passing_message = $array['passing_message'];
        $messagesBigTest->failed_message = $array['failed_message'];
        $messagesBigTest->correct_message = $array['correct_message'];
        $messagesBigTest->incorrect_message = $array['incorrect_message'];

        if ($array['passing_message'] != '' || $array['failed_message'] != '' || $array['correct_message'] != '' || $array['incorrect_message'] != '') {
            $messagesBigTest->save();
        }
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
        if (($firstTime == Constant::FIRST_TIME_TRUE) || !CheckDate::compareTwoTimes($date, $projectUpdatedAt)) {
            return $this->getGrade($lang);
        }
        if (($firstTime == Constant::FIRST_TIME_FALSE) && CheckDate::compareTwoTimes($date, $projectUpdatedAt)) {
            return $grade = null;
        }
    }

    /**
     * This function get all Grades
     *
     * @param $lang
     * @return mixed
     */
    public function getGrade($lang, $userId)
    {
        $result = DB::table('languages')
            ->join('grade_names', 'languages.id', 'grade_names.language_id')
            ->join('grades', 'grades.id', 'grade_names.grade_id')
            ->join('versions', 'versions.grade_id', 'grades.id')
            ->where('languages.lang_code', $lang)
            ->where('versions.published', Constant::PUBLISHED)
            ->orderBy('grade_no', 'asc')
            ->select('grade_names.name as title',
                'grades.content_type as content_type',
                'grade_names.grade_id as id',
                'grades.grade_no AS grade_no',
                'versions.big_test_id AS big_test_id',
                'grades.id AS grade_id',
                'languages.id AS language_id'
            )
            ->get();
        $arrayGrade = [];
        foreach ($result as $key => $temp) {
            if($this->checkVersion($temp->grade_id, $temp->big_test_id)) {
                $back_grounds = MyBackgroundPage::where('grade_id',$temp->id)->first();
                $messages_small_test = MessageSmallTest::where('grade_id',$temp->id)->where('language_id',$temp->language_id)->first();
                $messages_big_test = MessageBigTest::where('grade_id',$temp->id)->where('language_id',$temp->language_id)->first();
                if($temp->title!= '') {
                    $arrayGrade[] = array(
                        'title' => $temp->title,
                        'id' => $temp->id,
                        'grade_no' => $temp->grade_no,
                        'content_type' => $temp->content_type,
                        'grade_id' => $temp->grade_id,
                        'big_test_id' => $temp->big_test_id,
                        'status' => $this->getStatusGrade($temp->id, $userId),
                        'big_test_score' => $this->getBigTestScore($temp->id, $userId)['big_test_score'],
                        'updated_at' => $this->getBigTestScore($temp->id, $userId)['updated_at'],
                        'back_ground' => (count($back_grounds) > 0) ? Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.$back_grounds->image_path : '',
                        'version' => $this->checkVersion($temp->grade_id, $temp->big_test_id),
                        'big_passing_message' => (count($messages_big_test) > 0) ? $messages_big_test->passing_message : '',
                        'big_failed_message' => (count($messages_big_test) > 0) ? $messages_big_test->failed_message : '',
                        'big_correct_message' => (count($messages_big_test) > 0) ? $messages_big_test->correct_message : '',
                        'big_incorrect_message' => (count($messages_big_test) > 0) ? $messages_big_test->incorrect_message : '',
                        'small_passing_message' => (count($messages_small_test) > 0) ? $messages_small_test->passing_message : '',
                        'small_failed_message' => (count($messages_small_test) > 0) ? $messages_small_test->failed_message : '',
                        'small_correct_message' => (count($messages_small_test) > 0) ? $messages_small_test->correct_message : '',
                        'small_incorrect_message' => (count($messages_small_test) > 0) ? $messages_small_test->incorrect_message : '',
                    );
                }
            }
        }
//        print_r($arrayGrade);
//        exit;
        return $arrayGrade;
    }
    public function checkVersion($grade_id, $big_test_id){
        $version = BigTest::where('id', $big_test_id)->where('grade_id', $grade_id)->get();
        if(count($version)>0){
            return true;
        }else{
            return false;
        }
    }

    public function getStatusGrade($gradeId, $userId)
    {
        if($userId == null){
            return $status = Constant::STATUS_NO_TEST;
        }
        $status = Constant::STATUS_NO_TEST;
        $big_test = BigTest::where('grade_id', $gradeId)->first();
        if (!(count($big_test) > 0)) {
            return $status;
        } else {
            $big_test_id = $big_test->id;
            $logs_big_test = LogBigTest::where('big_test_id', $big_test_id)
                ->where('user_id', $userId)
                ->orderBy('point', 'desc')
                ->first();
            if (count($logs_big_test) > 0) {
                if($logs_big_test->result == 1) {
                    return $status = Constant::STATUS_TEST_PASS;
                } else {
                    return $status = Constant::STATUS_TEST_NO_PASS;
                }
            }
            return $status;
        }

    }
    public function getBigTestScore($gradeId, $userId)
    {
        $result = [];
        if($userId == null){
            return $status = Constant::STATUS_NO_TEST;
        }
        $big_test_score = Constant::STATUS_NO_TEST;
        $updated_at = null;
        $big_test = BigTest::where('grade_id', $gradeId)->first();
        if (!(count($big_test) > 0)) {
            return $result = array(
                'big_test_score' => $big_test_score,
                'updated_at' => $updated_at);
        } else {
            $big_test_id = $big_test->id;
            $logs_big_test = DB::table('logs_big_test')
                ->where('big_test_id', $big_test_id)
                ->where('user_id', $userId)
                ->orderBy('point', 'desc')->first();
            if (count($logs_big_test) > 0) {
                $big_test_score = $logs_big_test->point;
                $updated_at = $logs_big_test->updated_at;
            } else {
                $big_test_score = Constant::STATUS_NO_TEST;
                $updated_at = null;
            }
            return $result = array(
                'big_test_score' => $big_test_score,
                'updated_at' => $updated_at);
        }

    }
    public function processExportXML($languageId, $xmls=null)
    {
        $lang = count(Language::find($languageId)) > 0 ? Language::find($languageId)->lang_code : '';
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' . '<共通 lang="' . $lang . '" />');
	    $xmls->resetFieldNo();
        $grades = Grade::all()->sortBy('grade_no');
        foreach ($grades as $key => $v_grade) {

            /*$_is_tutorial = $v_grade->content_type == Constant::CONTENT_TYPE_GRADE_IS_TUTORIAL ? 'true' : 'false';
            $grade_is_tutorial = $v_grade->content_type == Constant::CONTENT_TYPE_GRADE_IS_COMA ? 'false' : $_is_tutorial;*/

            $v_grade_names = GradeName::where('grade_id', $v_grade->id)->where('language_id', $languageId)->first();
            if (count($v_grade_names) > 0) {
	            $grade = $xml->addChild('グレード');

                $grade->addChild('グレード名', $v_grade_names->name);
	            $my_background_pages = MyBackgroundPage::where('grade_id', $v_grade->id)->first();
	            if (count($my_background_pages) > 0) {
		            $grade->addChild('マイページ背景', $my_background_pages->image_path);
	            }
	            $big_test = BigTest::where('grade_id', $v_grade->id)->first();
	            if (count($big_test) > 0) {
		            $grade->addChild('合格点正答率', $big_test->pass_score_rate);
	            }

	            $v_messages_big_test = MessageBigTest::where('grade_id', $v_grade->id)
	                                                 ->where('language_id', $languageId)->first();
	            if (count($v_messages_big_test) > 0) {
		            $grade->addChild('大テスト合格メッセージ', $v_messages_big_test->passing_message);
		            $grade->addChild('大テスト不合格メッセージ', $v_messages_big_test->failed_message);
		            $grade->addChild('大テスト正解メッセージ', $v_messages_big_test->correct_message);
		            $grade->addChild('大テスト不正解メッセージ', $v_messages_big_test->incorrect_message);
	            }
	            $messages_small_test = MessageSmallTest::where('grade_id', $v_grade->id)
	                                                   ->where('language_id', $languageId)
	                                                   ->first();
	            if (count($messages_small_test) > 0) {
		            $grade->addChild('小テスト合格メッセージ', $messages_small_test->passing_message);
		            $grade->addChild('小テスト不合格メッセージ', $messages_small_test->failed_message);
		            $grade->addChild('小テスト正解メッセージ', $messages_small_test->correct_message);
		            $grade->addChild('小テスト不正解メッセージ', $messages_small_test->correct_message);
	            }

	            $xmls->resetFieldNo('versions', 'version_no', "grade_id=" . ($v_grade->id));
	            $versions = Version::where('grade_id', $v_grade->id)
	                               ->orderBy('grade_id')
	                               ->orderBy('version_no')->get();

	            foreach ($versions as $key_ver => $v_version) {
		            $version = $grade->addChild('バージョン');
                    $version_name = $v_version->name;
		            //$version_name = "grade-" . $v_grade->id . " version" . $v_version->id . " " . $v_version->name;
		            $version->addChild('バージョン名', $version_name);

		            $xmls->resetFieldNo('chapters', 'chapter_no', "version_id=" . ($v_version->id));
		            $chapters = Chapter::where('version_id', $v_version->id)
                                        ->orderBy('version_id')
                                        ->orderBy('chapter_no')->get();
		            if (count($chapters) > 0) {
			            foreach ($chapters as $key_chap => $v_chapters) {
				            $chapter = $version->addChild('チャプタ');
				            $v_chapter_names = ChapterName::where('chapter_id', $v_chapters->id)
				                                          ->where('language_id', $languageId)->first();
				            if (count($v_chapter_names) > 0) {
					            $chapter->addChild('チャプター名', $v_chapter_names->name);
					            /*$small_test = SmallTest::where('chapter_id', $v_chapters->id)->first();
					            if (count($small_test) > 0) {
					            }*/
				            }
                            $xmls->resetFieldNo('comas', 'frame_no', "chapter_id=" . ($v_chapters->id));
				            $comas = Coma::where('chapter_id', $v_chapters->id)
                                            ->orderBy('chapter_id')
                                            ->orderBy('frame_no')->get();
				            if (count($comas) > 0) {
					            foreach ($comas as $key_com => $v_coma) {

						            $coma_languages = ComaLanguage::where('coma_id', $v_coma->id)
						                                          ->where('language_id', $languageId)->first();
						            if (count($coma_languages) > 0) {
                                        $coma = $chapter->addChild('コマ');
							            $coma->addChild('画像', $coma_languages->image_path);
							            $coma->addChild('動画', $coma_languages->video_path);
							            $coma->addChild('音楽', $coma_languages->music_path);

                                        //$priority_check = $coma_languages->priority_check == 0 ? 'false' : 'true';
							            $coma->addChild('コマ名', $v_coma->frame_name);
							            $coma->addChild('説明', $coma_languages->description);
						            }
					            }
				            }

				            $small_tests = SmallTest::where('chapter_id', $v_chapters->id)->first();
				            if (count($small_tests) > 0) {
					            $chapter->addChild('合格点正答率', $small_tests->pass_score_rate);
					            $chapter->addChild('出題形式', $small_tests->question_format);
					            $chapter->addChild('選択肢表示形式', $small_tests->option_display_format);

					            $xmls->resetFieldNo('small_test_questions', 'question_no', "small_test_id=" . ($small_tests->id));
					            $small_test_questions = SmallTestQuestion::where('small_test_id', $small_tests->id)
                                                                        ->orderBy('small_test_id')
                                                                        ->orderBy('question_no')->get();
					            if (count($small_test_questions) > 0) {
						            foreach ($small_test_questions as $key_stq => $v_small_test_question) {
							            $small_test_problems = SmallTestQuestionProblem::where('small_test_question_id', $v_small_test_question->id)
							                                                           ->where('language_id', $languageId)
							                                                           ->first();
							            if (count($small_test_problems) > 0) {
								            $small_test_problem = $chapter->addChild('小テスト問題');
								            $small_test_problem->addChild('タイトル', $v_small_test_question->title);
								            $small_test_problem->addChild('問題形式', $v_small_test_question->question_format);
								            $small_test_problem->addChild('配点', $v_small_test_question->score);
								            $small_test_problem->addChild('問題文', $small_test_problems->problem_statement);
								            $small_test_problem->addChild('画像', $small_test_problems->image_path);
								            $small_test_problem->addChild('動画', $small_test_problems->video_path);

                                            //$priority_check = $small_test_problems->priority_check == 0 ? 'false' : 'true';
                                            $xmls->resetFieldNo('small_test_question_choices', 'choice_no', "small_test_question_id=" . ($v_small_test_question->id));
								            $small_test_question_choices = SmallTestQuestionChoice::where('small_test_question_id', $v_small_test_question->id)
								                                                                  ->where('language_id', $languageId)
                                                                                                  ->orderBy('small_test_question_id')
                                                                                                  ->orderBy('choice_no')->get();
                                            if (count($small_test_question_choices) > 0) {
                                                foreach ($small_test_question_choices as $key_stqc => $v_small_test_question_choice) {
                                                    $small_test_question_choice = $small_test_problem->addChild('選択肢');
                                                    $small_test_question_choice->addChild('選択肢説明', $v_small_test_question_choice->option_description);
                                                    $small_test_question_choice->addChild('画像', $v_small_test_question_choice->image_path);
                                                    $small_test_question_choice->addAttribute('正誤', $v_small_test_question_choice->true_or_false == 0 ? 'false' : 'true');
                                                }
                                            }
							            }
						            }
					            }
				            }
			            }

		            }
	            }
            }
        }
        return $xml->asXML();
    }

    public function updateMyPage($userId, $gradeId = 0, $imagePath = 'img')
    {
        $myPageBg = MyBackgroundPage::find($gradeId);
        if (!is_object($myPageBg)) {
            $myPageBg = new MyBackgroundPage();
            $myPageBg->created_at = date('Y-m-d H:i:s');
        }
        $myPageBg->user_id = $userId;
        $myPageBg->grade_id = $gradeId;
        $myPageBg->image_path = $imagePath;
        $myPageBg->updated_at = date('Y-m-d H:i:s');
        $myPageBg->save();

    }

    public function updateBigTest($gradeId = 0, $passScoreRate)
    {
        $bigTest = BigTest::where('grade_id', $gradeId)->first();
        if (!is_object($bigTest)) {
            $bigTest = new BigTest();
            $bigTest->setCreatedAt(date('Y-m-d H:i:s'));
            $bigTest->control_no = time();
            $bigTest->collection_id = 0;
            $bigTest->file_id = time();
            $bigTest->management_numbers = 0;
        }

        $bigTest->grade_id = $gradeId;
        $bigTest->pass_score_rate = $passScoreRate;
        $bigTest->setUpdatedAt(date('Y-m-d H:i:s'));
        $bigTest->save();

    }

    public function getPassScoreRate($gradeId)
    {
        $bigTest = BigTest::where('grade_id', $gradeId)->get()->first();
        if (is_object($bigTest)) {
            return $bigTest->pass_score_rate;
        } else {
            return '';
        }
    }

    public function getMyPageBg($gradeId)
    {
        $myPageBg = MyBackgroundPage::where('grade_id', $gradeId)->first();
        if (is_object($myPageBg))
        {
            return ['image_path' => $myPageBg->image_path,
                    'id' => $myPageBg->id
                ];
        }
        else
        {
            return ['image_path' => '',
                'id' => null
            ];
        }
    }
    public function deleteGrade($id){
        $grade = Grade::find($id);
        DB::beginTransaction();
        try
        {
            $grade->delete();
            DB::commit();
        }
        catch (\Exception $e)
        {
            DB::rollback();
            $errorMessage = 'Delete version error: ID: '. $id . ', message:' . $e->getMessage();
            \Log::info(print_r($errorMessage, true));
        }
    }
}