<?php

namespace App\Http\Controllers\API;

use App\Repositories\Tutorials;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ApiValidators\GradeValidator;
use App\Libs\Constants\Constant;

/**
 * This class manage all function of tutorial
 * Class TutorialController
 * @package App\Http\Controllers\API
 */
class TutorialController extends ApiController
{
    /**
     * This function get all tutorial
     * @param Tutorials $tutorials
     * @param $lang
     * @return array
     */
    public function postTutorial(Request $request, Tutorials $tutorials, $lang)
    {
        $validate = GradeValidator::validateRequestFirstTime($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        if ($request->first_time != Constant::FIRST_TIME_TRUE){
            $validate = GradeValidator::validateRequestInformation($request);
        }
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        $tutorials = $tutorials->getTutorial($request->date, $request->first_time, $lang);
        if (!$tutorials) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Tutorial download success', $tutorials);
    }

    /*
     * This function get all question of tutorial
     * @param Tutorials $tutorial
     * @param $lang
     * @return array
     */
    public function getQuestion(Tutorials $tutorials, $lang, $chapter_id)
    {
        $tutorials = $tutorials->getQuestion($lang, $chapter_id);
        if (!$tutorials) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Tutorial questions download success', $tutorials);

    }

    public function getAnswer()
    {

    }
}
