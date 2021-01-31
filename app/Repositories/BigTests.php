<?php

namespace App\Repositories;


use App\Models\Language;
use App\Models\BigTest;
use App\Models\MessageBigTest;
use App\Models\Version;
use Illuminate\Support\Facades\DB;
use App\Libs\Pass\PassScoreRate;
use App\Models\LogBigTest;

class BigTests extends Repository
{

    public $action = 'small_tests';

    /**
     * SmallTest constructor.
     */
    public function __construct()
    {
        parent::__construct(new BigTest());
    }

    public function postHistory($id, $point, $userId)
    {
        $versions = Version::where('big_test_id', $id)->orderBy('created_at', 'desc')->first();
        if(!count($versions)>0){
            return false;
        }
        $relate_version = $versions->relate_version;
        $bigTest = BigTest::find($id);
        if (!$bigTest) {
            return false;
        }
        $logs_big_test = new LogBigTest();
        $logs_big_test->user_id = $userId;
        $logs_big_test->big_test_id = $id;
        $logs_big_test->relate_version = $relate_version;
        $logs_big_test->point = $point;
        $logs_big_test->control_no = $bigTest->control_no;
        $logs_big_test->result = ($point >= $bigTest->pass_score_rate) ? true : false;
        $logs_big_test->save();
        return $logs_big_test;
    }

    public function fetchALl($languageId)
    {
        return DB::table('big_tests')
            ->join('messages_big_test', 'messages_big_test.big_test_id', 'big_tests.id')
            ->where('messages_big_test.language_id', $languageId)
            ->select(
                'big_tests.id AS id',
                'big_tests.grade_id AS grade_id',
                'big_tests.pass_score_rate AS pass_score_rate',
                'big_tests.control_no AS control_no',
                'big_tests.collection_id AS collection_id',
                'big_tests.file_id AS file_id',
                'big_tests.management_numbers AS management_numbers',
                'messages_big_test.id AS messages_big_test_id',
                'messages_big_test.grade_id AS messages_big_test_grade_id',
                'messages_big_test.big_test_id AS messages_big_test_big_test_id',
                'messages_big_test.language_id AS language_id',
                'messages_big_test.passing_message AS passing_message',
                'messages_big_test.failed_message AS failed_message',
                'messages_big_test.correct_message AS correct_message',
                'messages_big_test.incorrect_message AS incorrect_message',
                'messages_big_test.file_id AS file_id'
            )
            ->get();
    }

    public function processExportXML($languageId)
    {

        $lang = count(Language::find($languageId)) > 0 ? Language::find($languageId)->lang_code : '';
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?>' . '<共通 lang="' . $lang . '" />');
        $messages_big_test = MessageBigTest::where('language_id', $languageId)->get();
        if (count($messages_big_test) > 0) {
            foreach ($messages_big_test as $key => $v_messages_big_test) {
                $messages_big_test_xml = $xml->addChild('大テスト'.++$key);
                $messages_big_test_xml->addChild('合格メッセージ', $v_messages_big_test->passing_message);
                $messages_big_test_xml->addChild('不合格メッセージ', $v_messages_big_test->failed_message);
                $messages_big_test_xml->addChild('正解メッセージ', $v_messages_big_test->correct_message);
                $messages_big_test_xml->addChild('不正解メッセージ', $v_messages_big_test->incorrect_message);
            }
        }
        return $xml->asXML();
    }

    public function processImportXML($inputs)
    {
//        DB::table('big_tests')->truncate();
//        DB::table('messages_big_test')->where('messages_big_test.language_id', $inputs['大テスト'][0]['メッセージ']['@attributes']['language_id'])->delete();
        foreach ($inputs['大テスト'] as $key => $temp) {
            $big_test_check_exists = BigTest::find($temp['@attributes']['id']);
            if ($big_test_check_exists == null) {
                $big_tests = new BigTest();
            } else {
                $big_tests = BigTest::find($temp['@attributes']['id']);
            }
            $big_tests->id = $temp['@attributes']['id'];
            $big_tests->grade_id = $temp['@attributes']['grade_id'];
            $big_tests->pass_score_rate = $temp['@attributes']['pass_score_rate'];
            $big_tests->control_no = $temp['@attributes']['control_no'];
            $big_tests->collection_id = $temp['@attributes']['collection_id'];
            $big_tests->file_id = $temp['@attributes']['file_id'];
            $big_tests->management_numbers = $temp['@attributes']['management_numbers'];
            $big_tests->save();
            $message_big_test_check_exists = MessageBigTest::find($temp['メッセージ']['@attributes']['id']);
            if ($message_big_test_check_exists == null) {
                $message_big_tests = new MessageBigTest();
            } else {
                $message_big_tests = MessageBigTest::find($temp['メッセージ']['@attributes']['id']);
            }
            $message_big_tests->id = $temp['メッセージ']['@attributes']['id'];
            $message_big_tests->grade_id = $temp['メッセージ']['@attributes']['grade_id'];
            $message_big_tests->big_test_id = $temp['メッセージ']['@attributes']['big_test_id'];
            $message_big_tests->language_id = $temp['メッセージ']['@attributes']['language_id'];
            $message_big_tests->passing_message = $temp['メッセージ']['@attributes']['passing_message'];
            $message_big_tests->failed_message = $temp['メッセージ']['@attributes']['failed_message'];
            $message_big_tests->correct_message = $temp['メッセージ']['@attributes']['correct_message'];
            $message_big_tests->incorrect_message = $temp['メッセージ']['@attributes']['incorrect_message'];
            $message_big_tests->file_id = $temp['メッセージ']['@attributes']['file_id'];
            $message_big_tests->save();
        }
    }
    public function getMessageByGradeId($gradeId)
    {

        $rs = DB::table('messages_big_test')
            ->join('languages', 'languages.id', 'messages_big_test.language_id')
            //->join('small_tests', 'small_tests.id', 'messages_small_test.small_test_id')
            //->join('chapters', 'chapters.id', 'small_tests.chapter_id')
            //->join('versions', 'versions.id', 'chapters.version_id')
            //->where('versions.grade_id', $gradeId)

            ->where('messages_big_test.grade_id', $gradeId)
            ->select(
                'messages_big_test.id AS messages_big_test_id',
                'messages_big_test.big_test_id',
                'languages.lang_code',
                'messages_big_test.passing_message',
                'messages_big_test.failed_message',
                'messages_big_test.correct_message',
                'messages_big_test.incorrect_message'
            )->get();
//var_dump($rs);die;
        $data = [];
        if ($rs) {
            foreach ($rs AS $el) $data[$el->lang_code] = $el;
        }
        return $data;
    }
}