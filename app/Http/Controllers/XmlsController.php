<?php namespace App\Http\Controllers;

use App\Models\Grade;
use App\Repositories\BigTests;
use Illuminate\Http\Request;
use App\Repositories\Languages;
use App\Libs\Constants\Constant;
use App\Repositories\Xmls;
use App\Repositories\Grades;
use App\Repositories\Chapters;
use App\Repositories\ComaCategories;
use App\Repositories\SmallTests;
use App\Models\Language;
use App\Libs\Xml\XML2Array;

class XmlsController extends Controller
{
	public function import(Request $request, Languages $languages, Xmls $xmls, Grades $grades, Chapters $chapters, ComaCategories $comaCategories, SmallTests $smallTests, BigTests $bigTests)
    {
        if ($request->file('xmlfile')) {
            $errors = null;
            $content_file = file_get_contents($request->file('xmlfile'));
            $check_file = simplexml_load_string($content_file, 'SimpleXmlElement', LIBXML_NOERROR + LIBXML_ERR_FATAL + LIBXML_ERR_NONE);
            if ($check_file || ($check_file == false)) {
                $xmlArray = XML2Array::createArray($content_file);
                if (isset($xmlArray['共通'])) {
                    $attributes_lang = isset($xmlArray['共通']['@attributes']) ? $xmlArray['共通']['@attributes'] : '';
                    $lang_code = isset($attributes_lang['lang']) ? $attributes_lang['lang'] : '';
                    $language = Language::where('lang_code', $lang_code)->first();

                    $languageId = (count($language) > 0) ? $language->id : 0;
	                $xmls->processImportXML($xmlArray['共通'], $languageId);
                    $xmls->save($languageId, $request);
                }
                $errors = 'ンポートに成功したファイル。';
                return redirect()->route('xmls.input')->with('messages', $errors);
            }
            $errors = 'このXMLのファイルのコンテンツファイルを間違っています。 再チェックしてお願いします。';
            return redirect()->route('xmls.input')->with('messages', $errors);
        }
        return redirect()->route('xmls.input');
    }

    public function export(Request $request, Languages $languages, Xmls $xmls, Grades $grades, Chapters $chapters, ComaCategories $comaCategories, SmallTests $smallTests, BigTests $bigTests)
    {
        $params = $request->except('_token', '_method');
        $languages = $languages->getAll();
        $contentType = Constant::CONTENT_TYPES;
        if ($request->isMethod('post')) {
            $xmls->removeDraffData();
            $xmls->downloads($params, $languages, $grades, $chapters, $comaCategories, $smallTests, $bigTests);
        }
        return view('xmls.export', compact('params', 'languages', 'contentType'));
    }

    public function input(Request $request, Languages $languages, Xmls $xmls, Grades $grades, Chapters $chapters, ComaCategories $comaCategories, SmallTests $smallTests, BigTests $bigTests)
    {
        $grade_last = Grade::orderBy('grade_no', 'DESC')->first();
        $grade_last_id = 0;
        if(count($grade_last)>0){
            $grade_last_id = $grade_last->grade_no;
        }
        $params = $request->all();
        $languages = $languages->getAll();
        $contentType = Constant::CONTENT_TYPES;
        $listXML = $xmls->getXMLFiles($params);
        return view('xmls.import', compact('params', 'languages', 'contentType', 'listXML', 'grade_last_id'));
    }

    public function deleteXML(Xmls $xmls, Request $request, $id)
    {
        $xmls->deleteXML($id);
        return redirect()->route('xmls.input');
    }
/*
    private function import_message_small_test($message_small_test_id, $grade_id, $language_id, $messages)
    {
        if ($message_small_test_id) {
            $messages_small_test = MessageSmallTest::find($message_small_test_id);
            if (!(count($messages_small_test) > 0)) {
                DB::table('messages_small_test')
                    ->where('grade_id', $grade_id)
                    ->where('language_id', $language_id)
                    ->delete();
                $messages_small_test = new MessageSmallTest();
                $messages_small_test->id = $message_small_test_id;
            }
        } else {
            DB::table('messages_small_test')->where('grade_id', $grade_id)->delete();
            $messages_small_test = new MessageSmallTest();
        }
        $messages_small_test->grade_id = $grade_id;
        $messages_small_test->language_id = $language_id;
        $messages_small_test->passing_message = $messages['passing_message'];
        $messages_small_test->failed_message = $messages['failed_message'];
        $messages_small_test->correct_message = $messages['correct_message'];
        $messages_small_test->incorrect_message = $messages['incorrect_message'];
        $messages_small_test->save();
    }

    private function importContinueSmallTest($small_test_id, $v_chapter, $language_id)
    {
        echo "<pre>small_test";
        print_r($small_test_id);
        if (isset($v_chapter['小テスト問題'])) {
            $v_small_test_question = $v_chapter['小テスト問題'];
            foreach ($v_small_test_question as $key_small_test_question => $temp_small_test_question) {
                $small_test_question_id = null;
                if (!(is_numeric($key_small_test_question)) && ($key_small_test_question == '@attributes')) {
                    if (isset($v_small_test_question['@attributes'])) {
                        if (isset($v_small_test_question['@attributes']['小テスト問題ID'])) {
                            $small_test_question_id = $v_small_test_question['@attributes']['小テスト問題ID'];
                            $arr_small_test_question = array(
                                'title' => (isset($v_small_test_question['タイトル'])) ? $v_small_test_question['タイトル'] : '',
                                'question_format' => (isset($v_small_test_question['問題形式'])) ? (int)($v_small_test_question['問題形式']) : 0,
                                'score' => (isset($v_small_test_question['配点'])) ? (int)($v_small_test_question['配点']) : 0
                            );
                            $small_test_question_id = $this->import_small_test_question($small_test_question_id, $small_test_id, $arr_small_test_question);
                            echo "<pre>small_test_question_id";
                            print_r($small_test_question_id);
                            $small_test_question_problem_id = null;
                            if (isset($v_small_test_question['@attributes']['問題ID'])) {
                                $small_test_question_problem_id = $v_small_test_question['@attributes']['問題ID'];
                                $this->importContinueSmallTestQuestionProblem($small_test_question_problem_id, $small_test_question_id, $v_small_test_question, $language_id);
                            }
                            $small_test_question_problem_id = null;
                            if (isset($v_small_test_question['選択肢'])) {
                                $this->importContinueSmallTestQuestionChoice($small_test_question_id, $v_small_test_question['選択肢'], $language_id);
                            }
                        }
                    }
                    break;
                }
                if (is_numeric($key_small_test_question)) {
                    if (isset($temp_small_test_question['@attributes']) && isset($temp_small_test_question['@attributes']['小テスト問題ID'])) {
                        $small_test_question_id = $temp_small_test_question['@attributes']['小テスト問題ID'];
                        $arr_small_test_question = array(
                            'title' => (isset($temp_small_test_question['タイトル'])) ? $temp_small_test_question['タイトル'] : '',
                            'question_format' => (isset($temp_small_test_question['問題形式'])) ? (int)($temp_small_test_question['問題形式']) : 0,
                            'score' => (isset($temp_small_test_question['配点'])) ? (int)($temp_small_test_question['配点']) : 0
                        );
                        $small_test_question_id = $this->import_small_test_question($small_test_question_id, $small_test_id, $arr_small_test_question);
                        echo "<pre>small_test_question_id";
                        print_r($small_test_question_id);
                        if (isset($temp_small_test_question['@attributes']['問題ID'])) {
                            $small_test_question_problem_id = $temp_small_test_question['@attributes']['問題ID'];
                            $this->importContinueSmallTestQuestionProblem($small_test_question_problem_id, $small_test_question_id, $v_small_test_question, $language_id);
                        }
                        if (isset($temp_small_test_question['選択肢'])) {
                            $this->importContinueSmallTestQuestionChoice($small_test_question_id, $temp_small_test_question['選択肢'], $language_id);
                        }
                    }
                }
            }
        }
    }*/
}