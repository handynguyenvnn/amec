<?php
/**
 * Created by TuyenDD.
 * User: user
 * Date: 10/17/2017
 * Time: 10:17 AM
 */

namespace App\Repositories;

use App\Models\BigTest;
use App\Models\Chapter;
use App\Models\ChapterName;
use App\Models\Coma;
use App\Models\ComaLanguage;
use App\Models\Grade;
use App\Models\GradeName;
use App\Models\MessageBigTest;
use App\Models\MessageSmallTest;
use App\Models\MyBackgroundPage;
use App\Models\SmallTest;
use App\Models\SmallTestQuestion;
use App\Models\SmallTestQuestionChoice;
use App\Models\SmallTestQuestionProblem;
use App\Models\Version;

use App\Models\Xml;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Libs\Constants\Constant;

class Xmls extends Repository
{
    /**
     * Users constructor.
     */
    public function __construct() {

    }
    private $is_debug = false;
    public function downloads($params, $languages, Grades $grades, Chapters $chapters, ComaCategories $comaCategories, SmallTests $smallTests, BigTests $bigTests) {
        if (isset($params['language_id'])) {
	        $filename = 'download.xml';
	        foreach ($languages AS $el) {
		        if (intval($params['language_id']) == $el->id) {
			        $filename = $el->lang . date("-Y年m月d日H秒") .'.xml';
		        }
	        }
            $results = $grades->processExportXML($params['language_id'], $this);
            $file = 'exportxml_'.date("d_m_Y_H_i_s").'.xml';

            $doc = new \DomDocument('1.0', 'UTF-8');
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: text/xml; charset=utf-8");
            header("Content-Transfer-Encoding: binary");
            print_r ($results);die;
        }
    }

    /**
     * Get all xml files
     * @param array $params
     * @return mixed
     */
    public function getXMLFiles(array $params)
    {
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $this->query = DB::table('xmls')
            ->join('languages','languages.id', '=', 'xmls.language_id')
            ->select('xmls.id', 'xmls.name', 'xmls.content_type', 'languages.lang','xmls.version_name', 'xmls.created_at')
            ->orderBy('xmls.id','desc');

        if (!empty($params['xml_name'])) {
            $this->query->where('xmls.name', 'LIKE', '%' . $params['xml_name'] . '%');
        }
        if (!empty($params['language'])) {
            $this->query->where('xmls.language_id', '=', $params['language']);
        }
        if (!empty($params['content_type'])) {
            $this->query->where('xmls.content_type', '=', $params['content_type']);
        }
        return $this->query->paginate($perPage);
    }

    public function deleteXML($id) {
        $xmlFile = Xml::find($id);
        $path = 'xml/'.$xmlFile->name;
        Storage::delete($path);
        $xmlFile->delete();
    }
    public function resetFieldNo($table_name='grades', $field_name='grade_no', $where="", $isEcho = false) {
        if ($isEcho) {
            return "SET @num := -1; \n UPDATE `{$table_name}` src SET `{$field_name}` = @num := (@num+1) " . (($where != "") ? " WHERE {$where} " : "") . " ORDER BY `{$field_name}` ASC; \n";
        }
	    \DB::statement('SET @num := -1');
	    \DB::statement("UPDATE `{$table_name}` SET `{$field_name}` = @num := (@num+1) " . (($where != "") ? " WHERE {$where} " : "") . " ORDER BY `{$field_name}` ASC;");
    }
    public function getIdByNo( $table_name='grades', $where) {
	    $rs = DB::table($table_name)
	            ->select('id')
	            ->whereRaw($where)->first();
	    return $rs ? $rs->id : 0;
    }
    public function removeDraffData()
    {
        //grades	grade_no
        DB::statement("DELETE FROM `grade_names` WHERE grade_id IS NULL OR grade_id NOT IN (SELECT id FROM `grades`)");
        DB::statement("DELETE FROM `big_tests` WHERE grade_id IS NULL OR grade_id NOT IN (SELECT id FROM `grades`)");
        DB::statement("DELETE FROM `logs_big_test` WHERE big_test_id IS NULL OR big_test_id NOT IN (SELECT id FROM `big_tests`)");
        DB::statement("DELETE FROM `messages_big_test` WHERE grade_id IS NULL OR (grade_id NOT IN (SELECT id FROM `grades`) AND big_test_id NOT IN (SELECT id FROM `big_tests`))");
        DB::statement("DELETE FROM `my_background_pages` WHERE grade_id IS NULL OR grade_id NOT IN (SELECT id FROM `grades`)");
        //versions	version_no	grade_id
        DB::statement("DELETE FROM `versions` WHERE grade_id IS NULL OR grade_id NOT IN (SELECT id FROM `grades`)");
        //chapters	chapter_no	version_id
        DB::statement("DELETE FROM `chapters` WHERE version_id IS NULL OR version_id NOT IN (SELECT id FROM `versions`)");
        DB::statement("DELETE FROM `chapter_names` WHERE chapter_id IS NULL OR chapter_id NOT IN (SELECT id FROM `chapters`)");
        DB::statement("DELETE FROM `logs_chapter` WHERE chapter_id IS NULL OR chapter_id NOT IN (SELECT id FROM `chapters`)");
        //comas	frame_no	chapter_id
        DB::statement("DELETE FROM `comas` WHERE chapter_id IS NULL OR chapter_id NOT IN (SELECT id FROM `chapters`)");
        DB::statement("DELETE FROM `coma_languages` WHERE coma_id IS NULL OR coma_id NOT IN (SELECT id FROM `comas`)");
        //small_test_questions	question_no	small_test_id
        DB::statement("DELETE FROM `small_tests` WHERE chapter_id IS NULL OR chapter_id NOT IN (SELECT id FROM `chapters`)");
        DB::statement("DELETE FROM `small_test_questions` WHERE small_test_id IS NULL OR small_test_id NOT IN (SELECT id FROM `small_tests`)");
        DB::statement("DELETE FROM `logs_small_test` WHERE small_test_id IS NULL OR small_test_id NOT IN (SELECT id FROM `small_tests`)");
        DB::statement("DELETE FROM `messages_small_test` WHERE grade_id IS NULL OR (grade_id NOT IN (SELECT id FROM `grades`) AND small_test_id NOT IN (SELECT id FROM `small_tests`))");

        //small_test_question_choices	choice_no	small_test_question_id
        DB::statement("DELETE FROM `small_test_question_choices` WHERE small_test_question_id IS NULL OR small_test_question_id NOT IN (SELECT id FROM `small_test_questions`)");
    }
	public function processImportXML($inputs, $language_id)
	{
        $this->removeDraffData();
		if (empty($inputs) || !is_array($inputs)) return false;

        DB::table('grade_names')->where('language_id', $language_id)->delete();
        DB::table('chapter_names')->where('language_id', $language_id)->delete();
        DB::table('small_test_question_choices')->where('language_id', $language_id)->delete();
        DB::table('coma_languages')->where('language_id', $language_id)->delete();

		foreach ($inputs as $key => $v_grades) {
			if ($key == 'グレード') {
				$grade_no = 0;
                $v_grades = $this->convertArrOneToMany($v_grades, "グレード名");
				foreach ($v_grades as $key_grade => $v_grade) {
					$grade_id = $this->getIdByNo( 'grades', "grade_no={$grade_no}");
					$grade_id = $this->importGrades($v_grade, $grade_id, $language_id, $grade_no);
					if (isset($v_grade['バージョン'])) {
						$v_versions = $v_grade['バージョン'];
						$version_no = 0;
						//echo count($v_versions); var_dump($v_versions);die;
                        $v_versions = $this->convertArrOneToMany($v_versions, "バージョン名");
						foreach ($v_versions as $key_version => $v_version) {
						    if (isset($v_version['バージョン名'])) {
                                $version_id = $this->getIdByNo( 'versions', "grade_id={$grade_id} AND version_no={$version_no}");
                                $version_id = $this->importVersion($version_id, $grade_id, (isset($v_version['バージョン名'])) ? $v_version['バージョン名'] : '', $version_no);
                                if (isset($v_version['チャプタ'])) {

                                    $this->importChapter($v_version['チャプタ'], $version_id, $language_id, $grade_id);
                                }
                                $version_no++;
                            }
						}
					}
                    $grade_no++;
				}
			}
		}
	}
	private function convertArrOneToMany($rs, $key) {
	    if (isset($rs[$key])) {
	        return [$rs];
        }
        return $rs;
    }
	/**
	 * @Import:
	 * @table rades, grade_names
	 * @table my_background_pages
	 * @table big_tests
	 * @table messages_big_test
	 * @table messages_small_test
	 * @param $v_grade, $grade_id = 0, $language_id = 0
	 */
	private function importGrades($v_grade, $grade_id, $language_id, $grade_no=0)
	{
		//Grade
		if (intval($grade_id) > 0) {
			$grade = Grade::find($grade_id);
		} else {
			$grade = new Grade();
		}
		$grade->grade_no = $grade_no;
		$grade->content_type = Constant::CONTENT_TYPE_GRADE_IS_COMA;
		$grade->save();
		$grade_id = $grade->id;

		//grade_names
		$grade_names = (isset($v_grade['グレード名'])) ? $v_grade['グレード名'] : '';
		if ($grade_names != "") {
			$gradeName = new GradeName();
            $gradeName->grade_id = $grade_id;
            $gradeName->language_id = $language_id;
            $gradeName->name = $grade_names;
            $gradeName->save();
		}

		//my_background_pages
		$image_path = (isset($v_grade['マイページ背景'])) ? $v_grade['マイページ背景'] : '';
		if ($image_path != "") {
			DB::table('my_background_pages')->where('grade_id', $grade_id)->delete();
			$my_background_pages = new MyBackgroundPage();
			$my_background_pages->grade_id = $grade_id;
			$my_background_pages->image_path = $image_path;
			$my_background_pages->save();
		}

        $big_test_id = 0;
		if (isset($v_grade['合格点正答率'])) {
            $big_test = BigTest::where('grade_id', $grade_id)->first();
            $big_test_id = $big_test->id;
            if (count($big_test) > 0) {
                DB::table('big_tests')
                    ->where('id','<>', $big_test_id)
                    ->where('grade_id', $grade_id)
                    ->delete();
            } else {
                $big_test = new BigTest();
            }
            $big_test->pass_score_rate = (isset($v_grade['合格点正答率'])) ? $v_grade['合格点正答率'] : '0';
            $big_test->save();
        }

		//messages_big_test
		DB::table('messages_big_test')->where('grade_id', $grade_id)->where('language_id', $language_id)->delete();
		$messages_big_test                      = new MessageBigTest();
		$messages_big_test->grade_id            = $grade_id;
		$messages_big_test->big_test_id         = $big_test_id;
		$messages_big_test->language_id         = $language_id;
		$messages_big_test->passing_message     = (isset($v_grade['大テスト合格メッセージ'])) ? $v_grade['大テスト合格メッセージ'] : '';
		$messages_big_test->failed_message      = (isset($v_grade['大テスト不合格メッセージ'])) ? $v_grade['大テスト不合格メッセージ'] : '';
		$messages_big_test->correct_message     = (isset($v_grade['大テスト正解メッセージ'])) ? $v_grade['大テスト正解メッセージ'] : '';
		$messages_big_test->incorrect_message   = (isset($v_grade['大テスト不正解メッセージ'])) ? $v_grade['大テスト不正解メッセージ'] : '';
		$messages_big_test->save();

		//messages_small_test
		DB::table('messages_small_test')->where('grade_id', $grade_id)->where('language_id', $language_id)->delete();
		$messages_small_test                    = new MessageSmallTest();
		$messages_small_test->grade_id          = $grade_id;
		$messages_small_test->language_id       = $language_id;
		$messages_small_test->passing_message   = (isset($v_grade['小テスト合格メッセージ'])) ? $v_grade['小テスト合格メッセージ'] : '';
		$messages_small_test->failed_message    = (isset($v_grade['小テスト不合格メッセージ'])) ? $v_grade['小テスト不合格メッセージ'] : '';
		$messages_small_test->correct_message   = (isset($v_grade['小テスト正解メッセージ'])) ? $v_grade['小テスト正解メッセージ'] : '';
		$messages_small_test->incorrect_message = (isset($v_grade['小テスト不正解メッセージ'])) ? $v_grade['小テスト不正解メッセージ'] : '';
		$messages_small_test->save();

		return $grade_id;
	}

	private function importVersion($version_id = null, $grade_id, $version_name, $version_no=0)
	{
		if ($version_id) {
			$version = Version::find($version_id);
			$version->id = $version_id;
		} else {
			$version = new Version();
		}
		$version->grade_id = $grade_id;
		$version->name = $version_name;
		$version->version_no = $version_no;

		$version->save();
		return $version->id;
	}
	private function importChapter($v_chapters, $version_id, $language_id, $grade_id)
	{
		$chapter_no = 0;
        $v_chapters = $this->convertArrOneToMany($v_chapters, "チャプター名");
		foreach ($v_chapters as $key_chapter => $v_chapter) {
			$chapter_id = $this->getIdByNo( 'chapters', "version_id = {$version_id} AND chapter_no={$chapter_no}");
			$chapter_id = $this->import_chapter($v_chapter, $chapter_id, $version_id, $language_id, $chapter_no);

			$this->import_small_test($v_chapter, $chapter_id, $language_id, $grade_id);
			if (isset($v_chapter['コマ'])) {
				$v_comas = $v_chapter['コマ'];
				$frame_no = 0;
                $v_comas = $this->convertArrOneToMany($v_comas, "コマ名");
				foreach ($v_comas as $key_v_coma => $v_coma) {
					$coma_id = $this->getIdByNo( 'comas', "frame_no={$frame_no}");
					if ($coma_id > 0) {
						$coma = Coma::find($coma_id);
						$coma->id = $coma_id;
					} else {
						$coma = new Coma();
                        $coma_id = $coma->id;
					}
					$coma->frame_no = $frame_no;
					$coma->chapter_id = $chapter_id;
					$coma->coma_category_id = 2;
					$coma->frame_name = (isset($v_coma['コマ名'])) ? $v_coma['コマ名'] : '';
					$coma->save();
					$this->import_coma_language($v_coma, $coma_id, $language_id);
                    $frame_no++;
				}
			}
            $chapter_no++;
		}
	}
	private function import_chapter($v_chapters, $chapter_id = null, $version_id, $language_id=1, $chapter_no=0)
	{
		if ($chapter_id) {
			$chapter = Chapter::find($chapter_id);
		} else {
			$chapter = new Chapter();
		}
        $chapter->chapter_no = $chapter_no;
		$chapter->version_id = $version_id;
		$chapter->save();
		$chapter_id = $chapter->id;

        $name = (isset($v_chapters['チャプター名'])) ? $v_chapters['チャプター名'] : '';
		$chapter_name = new ChapterName();
		$chapter_name->chapter_id = $chapter_id;
		$chapter_name->language_id = $language_id;
		$chapter_name->name = $name;
		$chapter_name->save();
		return $chapter_id;
	}
	private function import_small_test($v_chapter, $chapter_id, $language_id, $grade_id)
	{
        $small_test = SmallTest::where('chapter_id', $chapter_id)->first();
		if (count($small_test) > 0) {
            $st = SmallTest::where('chapter_id', $chapter_id)->where('id', '<>', $small_test->id)->get();
            if (count($st) > 0) {
                $Ids = [];
                foreach ($st AS $el) $Ids[] = $el->id;
                DB::table('small_tests')
                    ->where('chapter_id', $chapter_id)
                    ->whereIn('id', $Ids)
                    ->delete();
            }
            $small_test = SmallTest::find($small_test->id);
		} else {
			$small_test = new SmallTest();
		}

		//echo $chapter_id, "=", intval((isset($v_chapter['合格点正答率'])) ? ($v_chapter['合格点正答率']) : 0), "<br />";
		$small_test->chapter_id = $chapter_id;
		$small_test->pass_score_rate = intval((isset($v_chapter['合格点正答率'])) ? ($v_chapter['合格点正答率']) : 0);
		$small_test->question_format = intval((isset($v_chapter['出題形式'])) ? ($v_chapter['出題形式']) : 0);
		$small_test->option_display_format = intval((isset($chapter['選択肢表示形式'])) ? (int)$v_chapter['選択肢表示形式'] : 0);
		$small_test->save();

		$small_test_id = $small_test->id;
        DB::table('messages_small_test')->where('grade_id', $grade_id)->where('language_id', $language_id)->update(['small_test_id' => $small_test_id]);

		if (isset($v_chapter['小テスト問題'])) {
			$v_small_test_question = $v_chapter['小テスト問題'];

			$question_no = 0;
            $v_small_test_question = $this->convertArrOneToMany($v_small_test_question, "タイトル");
			foreach ($v_small_test_question as $key_small_test_question => $temp_small_test_question) {
				$small_test_question_id = $this->getIdByNo( 'small_test_questions', "small_test_id={$small_test_id} AND question_no={$question_no}");

				if ($small_test_question_id) {
					$small_test_question = SmallTestQuestion::find($small_test_question_id);
					$small_test_question->id = $small_test_question_id;
				} else {
					$small_test_question = new SmallTestQuestion();
				}
				$small_test_question->question_no = $question_no;

				$small_test_question->small_test_id = $small_test_id;
				$small_test_question->title = (isset($temp_small_test_question['タイトル'])) ? $temp_small_test_question['タイトル'] : '';
				$small_test_question->question_format = (isset($temp_small_test_question['問題形式'])) ? (int)($temp_small_test_question['問題形式']) : 0;
				$small_test_question->score = (isset($temp_small_test_question['配点'])) ? (int)($temp_small_test_question['配点']) : 0;
				$small_test_question->save();
				$small_test_question_id = $small_test_question->id;

				$this->importContinueSmallTestQuestionProblem($small_test_question_id, $temp_small_test_question, $language_id);

				if (isset($temp_small_test_question['選択肢'])) {
					$this->importContinueSmallTestQuestionChoice($small_test_question_id, $temp_small_test_question['選択肢'], $language_id);
				}
                $question_no++;
			}
		}
		return $small_test->id;
	}
	private function importContinueSmallTestQuestionProblem($small_test_question_id, $v_small_test_question, $language_id)
	{
		$priority_check_problem = 0;
		if (isset($v_small_test_question['@attributes']) && isset($v_small_test_question['@attributes']['優先チェック'])) {
			$priority_check_problem = $v_small_test_question['@attributes']['優先チェック']  == 'true' ? 1 : 0;
		}

        DB::table('small_test_question_problems')
            ->where('small_test_question_id', $small_test_question_id)
            ->where('language_id', $language_id)
            ->delete();

		//echo $small_test_question_id, "/" . (isset($v_small_test_question['問題文'])) ? $v_small_test_question['問題文'] : '';
        $problem = new SmallTestQuestionProblem();
        $problem->small_test_question_id = $small_test_question_id;
        $problem->problem_statement = (isset($v_small_test_question['問題文'])) ? $v_small_test_question['問題文'] : '';
        $problem->image_path = (isset($v_small_test_question['画像'])) ? $v_small_test_question['画像'] : '';
        $problem->video_path = (isset($v_small_test_question['動画'])) ? $v_small_test_question['動画'] : '';
        $problem->priority_check = intval($priority_check_problem);
        $problem->language_id = $language_id;
        $problem->save();

		return $problem->id;
	}
	private function importContinueSmallTestQuestionChoice($small_test_question_id, $v_small_test_question_choice, $language_id)
	{
		if ($v_small_test_question_choice) {
			$choice_no = $option_value = 0;
			//var_dump($v_small_test_question_choice);
			foreach ($v_small_test_question_choice as $key_small_test_question_choice => $temp_small_test_question_choice) {
				$small_test_question_choice_id = null;
				$true_or_false = null;
                $option_value++;
				$option_value = $option_value;
				if (isset($temp_small_test_question_choice['@attributes']) && isset($temp_small_test_question_choice['@attributes']['正誤'])) {
					$true_or_false = $temp_small_test_question_choice['@attributes']['正誤'] == 'true' ? 1 : 0;
				}

				if (isset($temp_small_test_question_choice['@attributes']) && isset($temp_small_test_question_choice['@attributes']['選択肢No']) && ($v_small_test_question_choice['@attributes']['選択肢No'] !='')) {
					$option_value = $temp_small_test_question_choice['@attributes']['選択肢No'];
				}
				if (isset($temp_small_test_question_choice['@attributes']) && isset($temp_small_test_question_choice['@attributes']['選択肢ID'])) {
					$small_test_question_choice_id = $temp_small_test_question_choice['@attributes']['選択肢ID'];
				}
				//echo $small_test_question_id, "/";
				$this->import_small_test_question_choice($small_test_question_id, $language_id, [
                    'option_value' => $option_value,
                    'option_description' => (isset($temp_small_test_question_choice['選択肢説明'])) ? $temp_small_test_question_choice['選択肢説明'] : '',
                    'image_path' => (isset($temp_small_test_question_choice['画像'])) ? $temp_small_test_question_choice['画像'] : '',
                    'true_or_false' => $true_or_false
                ]);
                $choice_no++;
			}
		}
	}
	private function import_small_test_question_choice($small_test_question_id, $language_id, $inputs)
	{

		$small_test_question_choice = new SmallTestQuestionChoice();
		$small_test_question_choice->small_test_question_id = $small_test_question_id;
		$small_test_question_choice->option_value = $inputs['option_value'];
		$small_test_question_choice->true_or_false = $inputs['true_or_false'];
		$small_test_question_choice->language_id = $language_id;
		$small_test_question_choice->option_description = $inputs['option_description'];
		$small_test_question_choice->image_path = $inputs['image_path'];
		$small_test_question_choice->save();
	}
	private function import_coma_language($v_comas, $coma_id, $language_id) {
		$priority_check = 0;
		if (isset($v_comas['@attributes']) && isset($v_comas['@attributes']['優先チェック'])) {
			$priority_check = $v_comas['@attributes']['優先チェック'] == 'true' ? 1 : 0;
		}
        $coma_language = new ComaLanguage();
		$coma_language->coma_id = $coma_id;
		$coma_language->music_path = (isset($v_comas['音楽'])) ? $v_comas['音楽'] : '';
		$coma_language->description = (isset($v_comas['説明'])) ? $v_comas['説明'] : '';
		$coma_language->language_id = $language_id;
		$coma_language->video_path = (isset($v_comas['動画'])) ? $v_comas['動画'] : '';
		$coma_language->image_path = (isset($v_comas['画像'])) ? $v_comas['画像'] : '';
		$coma_language->priority_check = intval($priority_check);
		$coma_language->save();
	}
	public function save($languageId, $request)
    {
        $originName = $request->file('xmlfile')->getClientOriginalName();
        $request->file('xmlfile')->storeAs('xml', $originName);
        $xml_record = new Xml();
        $xml_record->name = $originName;
        $xml_record->version_name = 'バージョン名';
        $xml_record->language_id = $languageId;
        date_default_timezone_set('Asia/Tokyo');
        $xml_record->created_at = date('Y-m-d H:i:s', time());
        $xml_record->save();

        return $xml_record;
    }
}