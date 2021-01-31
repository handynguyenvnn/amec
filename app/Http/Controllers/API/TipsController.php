<?php

namespace App\Http\Controllers\API;

use App\Repositories\Comas;
use App\Repositories\Tips;
use Illuminate\Http\Request;
use App\Libs\ApiValidators\GradeValidator;
use App\Http\Controllers\Controller;
use App\Libs\Constants\Constant;

/**
 * This class manage all function of tips
 * Class TipsController
 * @package App\Http\Controllers\API
 */
class TipsController extends ApiController
{
    /**
     * This function get all coma of Tips
     * @param Tips $tips
     * @param $lang
     * @return array
     */
    public function getComa( Tips $tips, $lang){
        $res = $tips->getComa($lang);
        if(!$res) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Tip download success', $res);
    }
    /**
     * This function get all questions of tips
     * @param Tips $tips
     * @param $lang
     * @return array
     */
    public function getQuestion( Tips $tips, $lang)
    {
        $res = $tips->getQuestion($lang);
        if(!$res) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Tip questions download success', $res);

    }

    public function postTip( Request $request, $lang, Tips $tips )
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
        if (!$tips->getTip($request->date, $request->first_time, $lang )) {
            return $this->result(true, 'grade');
        }
        return $this->result(true, 'Chapter', $tips->getTip($request->date, $request->first_time, $lang ));

    }
}
