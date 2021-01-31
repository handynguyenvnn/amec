<?php

namespace App\Repositories;


use App\Models\MessageBigTest;
use App\Libs\Constants\Constant;

class MessagesBigTests extends Repository
{

    /**
     * MessageBigTest constructor.
     */
    public function __construct()
    {
        parent::__construct(new MessageBigTest());
    }
    public function save($request, $languages)
    {
        if ($languages) {
            foreach ($languages AS $lang) {
                $langCode = $lang->lang_code;
                $saveDataJA = array(
                    'language_id' => $lang->id,
                    'passing_message' => $request["{$langCode}_passing_message"],
                    'failed_message' => $request["{$langCode}_failed_message"],
                    'correct_message' => $request["{$langCode}_correct_message"],
                    'incorrect_message' => $request["{$langCode}_incorrect_message"],
                );
                $this->saveByLanguage($saveDataJA);
            }
        }
        /*
        $saveDataJA = array(
            'language_id' => Constant::LANG_JA_ID,
            'passing_message' => $request['ja_passing_message'],
            'failed_message' => $request['ja_failed_message'],
            'correct_message' => $request['ja_correct_message'],
            'incorrect_message' => $request['ja_incorrect_message'],
        );
        $this->saveByLanguage($saveDataJA);

        $saveDataEN = array(
            'language_id' => Constant::LANG_EN_ID,
            'passing_message' => $request['en_passing_message'],
            'failed_message' => $request['en_failed_message'],
            'correct_message' => $request['en_correct_message'],
            'incorrect_message' => $request['en_incorrect_message'],
        );
        $this->saveByLanguage($saveDataEN);

        $saveDataVN = array(
            'language_id' => Constant::LANG_VN_ID,
            'passing_message' => $request['vn_passing_message'],
            'failed_message' => $request['vn_failed_message'],
            'correct_message' => $request['vn_correct_message'],
            'incorrect_message' => $request['vn_incorrect_message'],
        );
        $this->saveByLanguage($saveDataVN);
        */
    }

    /**
     * @param $saveData
     */
    private function saveByLanguage( $saveData){
        $data = new MessageBigTest();
        $data->big_test_id = rand(10,100);
        $data->file_id = rand(10,100);
        $data->language_id = $saveData['language_id'];
        $data->passing_message = $saveData['passing_message'];
        $data->failed_message = $saveData['failed_message'];
        $data->correct_message = $saveData['correct_message'];
        $data->incorrect_message = $saveData['incorrect_message'];
        $data->save();
    }

}