<?php

namespace App\Repositories;


use App\Models\Language;
use App\Models\MessageSmallTest;
use App\Models\SmallTestQuestion;
use App\Models\SmallTestQuestionChoice;
use App\Models\SmallTestQuestionProblem;
use App\Models\Version;
use Illuminate\Support\Facades\DB;
use App\Libs\Constants\Constant;
use Illuminate\Support\Facades\Session;

class SmallTestQuestions extends Repository
{

    /**
     * SmallTestQuestions constructor.
     */
    public function __construct()
    {
        parent::__construct(new SmallTestQuestion());
    }
    public function store(array $input)
    {
        if(isset($input['versionId'])){
            $version = Version::find($input['versionId']);
        }else{
            $version = new Version();
        }
        $version->name = $input['version_name'];
        $version->save();
        $languages = Language::all();
        if(count($languages)>0) {
            foreach ($languages as $key => $language) {
                if (isset($input[$language->lang_code . '_id'])) {
                    $messages_small_test = MessageSmallTest::find($input[$language->lang_code . '_id']);
                } else {
                    $messages_small_test = new MessageSmallTest();
                }
                $messages_small_test->grade_id = $input['gradeId'];
                $messages_small_test->language_id = $language->id;
                $messages_small_test->passing_message = $input[$language->lang_code . '_passing_message'];
                $messages_small_test->failed_message = $input[$language->lang_code . '_failed_message'];
                $messages_small_test->correct_message = $input[$language->lang_code . '_correct_message'];
                $messages_small_test->incorrect_message = $input[$language->lang_code . '_incorrect_message'];
                $messages_small_test->save();
            }
        }
    }

    public function searchByAjax($name, $smallTestId){
        return SmallTestQuestion::where('small_test_id', $smallTestId)->where('title', 'LIKE', '%' . $name . '%')->get();
    }
    public function getByAjax($id){
        $results = array();
        $small_test_questions = DB::table('small_test_questions')
            ->where('small_test_questions.id', $id)
            ->get();
//        return $small_test_questions;
        if(count($small_test_questions)>0) {
            foreach ($small_test_questions as $small_test_question) {
                $results['id'] = $small_test_question->id;
                $results['small_test_question_id'] = $small_test_question->small_test_id;
                $results['title'] = $small_test_question->title;
                $results['score'] = $small_test_question->score;
                $results['question_format_questions'] = $small_test_question->question_format;
                $small_test_question_problems = DB::table('small_test_question_problems')
                    ->where('small_test_question_problems.small_test_question_id', $small_test_question->id)
                    ->get();
                foreach ($small_test_question_problems as $small_test_question_problem){
                    $language_id = $small_test_question_problem->language_id;
                    $language_code = Language::find($language_id)->lang_code;
                    $results["{$language_code}_image_path"] = $small_test_question_problem->image_path;
                    $results["{$language_code}_video_path"] = $small_test_question_problem->video_path;
                    $results["{$language_code}_problem_statement"] = $small_test_question_problem->problem_statement;
                    $results["{$language_code}_small_test_problem_id"] = $small_test_question_problem->small_test_problem_id;
                    $results["{$language_code}_priority_check"] = intval($small_test_question_problem->priority_check);
                }
                $small_test_question_choices = DB::table('small_test_question_choices')
                    ->where('small_test_question_choices.small_test_question_id', $small_test_question->id)
                    ->orderBy('option_value', 'ASC')
                    ->get();
                foreach ($small_test_question_choices as $small_test_question_choice){
                    $language_id = $small_test_question_choice->language_id;
                    $language_code = Language::find($language_id)->lang_code;
                    $results["{$language_code}"]['description'][] = $small_test_question_choice->option_description;
                    $results["{$language_code}"]['choices_image_path'][] = $small_test_question_choice->image_path;
                    $results["{$language_code}"]['small_test_choice_id'][] = $small_test_question_choice->id;
                    $results["{$language_code}"]['true_or_false'][] = $small_test_question_choice->true_or_false;
                    $results["{$language_code}"]['option_value'][] = $small_test_question_choice->option_value;
                    $results["{$language_code}"]['total_choice'] = count($results["{$language_code}"]['description']);
                }
            }
        }
        return $results;
//            ->join('small_test_question_problems', 'small_test_question_problems.small_test_question_id','small_test_questions.id')
//            ->join('small_test_question_choices', 'small_test_question_choices.small_test_question_id','small_test_questions.id')
//            ->join('languages', 'languages.id','small_test_question_problems.language_id')
//            ->select('small_test_questions.id AS id',
//                'small_test_questions.title AS title',
//                'languages.lang_code AS lang_code',
//                'small_test_questions.id AS small_test_question_id',
//                'small_test_questions.score AS score',
//                'small_test_questions.question_format AS question_format_questions',
//                'small_test_question_problems.problem_statement AS problem_statement',
//                'small_test_question_problems.id AS small_test_problem_id',
//                'small_test_question_problems.language_id AS language_id',
//                'small_test_question_problems.priority_check AS priority_check',
//                'small_test_question_problems.image_path AS image_path',
//                'small_test_question_problems.video_path AS video_path',
//                'small_test_question_choices.language_id AS language_choice_id',
//                'small_test_question_choices.option_description AS option_description',
//                'small_test_question_choices.option_value AS option_value',
//                'small_test_question_choices.id AS small_test_question_choice_id',
//                'small_test_question_choices.image_path AS choices_image_path',
//                'small_test_question_choices.true_or_false AS true_or_false',
//                'small_test_question_choices.choice_no',
//                'languages.lang AS lang'
//            )
//            ->get();

//        $arrayResult = array();
//        foreach ($result as $item) {
//            $language_id = $item->language_id;
//            $language_code = $item->lang_code;
//            $arrayResult["{$language_code}_image_path"] = $item->image_path;
//            $arrayResult["{$language_code}_video_path"] = $item->video_path;
//            $arrayResult["{$language_code}_problem_statement"] = $item->problem_statement;
//            $arrayResult["{$language_code}_small_test_problem_id"] = $item->small_test_problem_id;
//            $arrayResult["{$language_code}_priority_check"] = intval($item->priority_check);
//
//            if ($item->language_choice_id == $language_id) {
//                $arrayResult["{$language_code}"]['description'][] = $item->option_description;
//                $arrayResult["{$language_code}"]['choices_image_path'][] = $item->choices_image_path;
//                $arrayResult["{$language_code}"]['small_test_choice_id'][] = $item->small_test_question_choice_id;
//                $arrayResult["{$language_code}"]['true_or_false'][] = $item->true_or_false;
//                $arrayResult["{$language_code}"]['total_choice'] = count($arrayResult["{$language_code}"]['description']);
//            }
//            $arrayResult['title'] = $item->title;
//            $arrayResult['score'] = $item->score;
//            $arrayResult['id'] = $item->id;
//            $arrayResult['question_format_questions'] = $item->question_format_questions;
//            $arrayResult['small_test_question_id'] = $item->small_test_question_id;
//        }
//        return $arrayResult;
    }
    public function createSmallTestQuestion($input)
    {
        $smallTestQuestion= new SmallTestQuestion();
        $smallTestQuestion->title = $input['title_small_test_question'];
        $smallTestQuestion->score = $input['score'];
        $smallTestQuestion->save();
        $this->createSmallTestQuestionProblems(Constant::LANG_JA_ID, array('problem_statement'=>$input['ja_problem_statement']));
        $this->createSmallTestQuestionProblems(Constant::LANG_EN_ID, array('problem_statement'=>$input['en_problem_statement']));
        $this->createSmallTestQuestionProblems(Constant::LANG_VN_ID, array('problem_statement'=>$input['vn_problem_statement']));
        $this->createSmallTestQuestionChoices(Constant::LANG_JA_ID,Constant::OPTION_VALUE_FIRST, array('option_description'=>$input['ja_option_description_first']));
        $this->createSmallTestQuestionChoices(Constant::LANG_JA_ID,Constant::OPTION_VALUE_SECOND, array('option_description'=>$input['ja_option_description_second']));
        $this->createSmallTestQuestionChoices(Constant::LANG_JA_ID,Constant::OPTION_VALUE_THIRD, array('option_description'=>$input['ja_option_description_third']));
        $this->createSmallTestQuestionChoices(Constant::LANG_JA_ID,Constant::OPTION_VALUE_SECOND, array('option_description'=>$input['ja_option_description_fourth']));
        $this->createSmallTestQuestionChoices(Constant::LANG_EN_ID,Constant::OPTION_VALUE_FIRST, array('option_description'=>$input['en_option_description_first']));
        $this->createSmallTestQuestionChoices(Constant::LANG_EN_ID,Constant::OPTION_VALUE_SECOND, array('option_description'=>$input['en_option_description_second']));
        $this->createSmallTestQuestionChoices(Constant::LANG_EN_ID,Constant::OPTION_VALUE_THIRD, array('option_description'=>$input['en_option_description_third']));
        $this->createSmallTestQuestionChoices(Constant::LANG_EN_ID,Constant::OPTION_VALUE_SECOND, array('option_description'=>$input['en_option_description_fourth']));
        $this->createSmallTestQuestionChoices(Constant::LANG_VN_ID,Constant::OPTION_VALUE_FIRST, array('option_description'=>$input['vn_option_description_first']));
        $this->createSmallTestQuestionChoices(Constant::LANG_VN_ID,Constant::OPTION_VALUE_SECOND, array('option_description'=>$input['vn_option_description_second']));
        $this->createSmallTestQuestionChoices(Constant::LANG_VN_ID,Constant::OPTION_VALUE_THIRD, array('option_description'=>$input['vn_option_description_third']));
        $this->createSmallTestQuestionChoices(Constant::LANG_VN_ID,Constant::OPTION_VALUE_SECOND, array('option_description'=>$input['vn_option_description_fourth']));
    }
    public function createSmallTestQuestionProblems( $langId, array $input)
    {
        $smallTestQuestionProblem = new SmallTestQuestionProblem();
        $smallTestQuestionProblem->language_id = $langId;
        $smallTestQuestionProblem->problem_statement = $input['problem_statement'];
        $smallTestQuestionProblem->save();
    }
    public function createSmallTestQuestionChoices($langId, $optionValue, array $input)
    {
        $smallTestQuestionChoice = new SmallTestQuestionChoice();
        $smallTestQuestionChoice->language_id = $langId;
        $smallTestQuestionChoice->option_value = $optionValue;
        $smallTestQuestionChoice->option_description = $input['option_description'];
        $smallTestQuestionChoice->save();
    }
    public function updateSmallTestQuestion($input, $id )
    {
        $smallTestQuestion = SmallTestQuestion::find($id);
        $smallTestQuestion->title = $input['title_small_test_question'];
        $smallTestQuestion->score = $input['score'];
        $smallTestQuestion->save();
        $this->updateSmallTestQuestionProblems($id,Constant::LANG_JA_ID, array('problem_statement'=>$input['ja_problem_statement']));
        $this->updateSmallTestQuestionProblems($id,Constant::LANG_EN_ID, array('problem_statement'=>$input['en_problem_statement']));
        $this->updateSmallTestQuestionProblems($id,Constant::LANG_VN_ID, array('problem_statement'=>$input['vn_problem_statement']));
        $this->updateSmallTestQuestionChoices($id, Constant::LANG_JA_ID,Constant::OPTION_VALUE_FIRST, array('option_description'=>$input['ja_option_description_first']));
        $this->updateSmallTestQuestionChoices($id, Constant::LANG_JA_ID,Constant::OPTION_VALUE_SECOND, array('option_description'=>$input['ja_option_description_second']));
        $this->updateSmallTestQuestionChoices($id, Constant::LANG_JA_ID,Constant::OPTION_VALUE_THIRD, array('option_description'=>$input['ja_option_description_third']));
        $this->updateSmallTestQuestionChoices($id, Constant::LANG_JA_ID,Constant::OPTION_VALUE_SECOND, array('option_description'=>$input['ja_option_description_fourth']));
        $this->updateSmallTestQuestionChoices($id, Constant::LANG_EN_ID,Constant::OPTION_VALUE_FIRST, array('option_description'=>$input['en_option_description_first']));
        $this->updateSmallTestQuestionChoices($id, Constant::LANG_EN_ID,Constant::OPTION_VALUE_SECOND, array('option_description'=>$input['en_option_description_second']));
        $this->updateSmallTestQuestionChoices($id, Constant::LANG_EN_ID,Constant::OPTION_VALUE_THIRD, array('option_description'=>$input['en_option_description_third']));
        $this->updateSmallTestQuestionChoices($id, Constant::LANG_EN_ID,Constant::OPTION_VALUE_SECOND, array('option_description'=>$input['en_option_description_fourth']));
        $this->updateSmallTestQuestionChoices($id, Constant::LANG_VN_ID,Constant::OPTION_VALUE_FIRST, array('option_description'=>$input['vn_option_description_first']));
        $this->updateSmallTestQuestionChoices($id, Constant::LANG_VN_ID,Constant::OPTION_VALUE_SECOND, array('option_description'=>$input['vn_option_description_second']));
        $this->updateSmallTestQuestionChoices($id, Constant::LANG_VN_ID,Constant::OPTION_VALUE_THIRD, array('option_description'=>$input['vn_option_description_third']));
        $this->updateSmallTestQuestionChoices($id, Constant::LANG_VN_ID,Constant::OPTION_VALUE_SECOND, array('option_description'=>$input['vn_option_description_fourth']));
    }
    public function updateSmallTestQuestionProblems($id, $langId, array $input)
    {
        $smallTestQuestionProblem = SmallTestQuestionProblem::where('small_test_question_id', $id)
            ->where('language_id',$langId)->first();
        $smallTestQuestionProblem->problem_statement = $input['problem_statement'];
        $smallTestQuestionProblem->save();
    }
    public function updateSmallTestQuestionChoices($id, $langId, $optionValue, array $input)
    {
        $smallTestQuestionChoice = SmallTestQuestionChoice::where('small_test_question_id', $id)
            ->where('language_id', $langId)
            ->where('option_value', $optionValue)
            ->first();
        $smallTestQuestionChoice->option_description = $input['option_description'];
        $smallTestQuestionChoice->save();
    }

}