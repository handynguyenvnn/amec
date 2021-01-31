<?php

namespace App\Http\Controllers\API;

use App\Repositories\Comas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ApiValidators\GradeValidator;
use App\Libs\Constants\Constant;
use JWTAuth;
use Hash;

/**
 * This class manage all function of coma
 * Class ComaController
 * @package App\Http\Controllers\API
 */
class ComaController extends ApiController
{
    /**
     * This function get all Coma
     * @param Request $request
     * @param $lang
     * @param $gradeId
     * @param Comas $comas
     * @return array
     */
    public function postComa(Request $request, $lang, $gradeId, Comas $comas)
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
        $userId = JWTAuth::parseToken()->authenticate()->id;
        if (!$comas->getComa($request->date, $request->first_time, $lang, $gradeId, $userId )) {
            return $this->result(true, 'grade');
        }
        return $this->result(true, 'Chapter', $comas->getComa($request->date, $request->first_time, $lang, $gradeId,$userId ));
    }

    /**
     * This function get all Coma questions
     * @param $lang
     * @param $chapterId
     * @param Comas $comas
     * @return array
     */
    public function getQuestion($lang, $chapterId, Comas $comas)
    {
        set_time_limit(60);
        $comas = $comas->getQuestion($lang, $chapterId);
        if (!$comas) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Coma questions download success', $comas);

    }

    /**
     * This function get all Coma Big Test
     * @param $lang
     * @param $grade_id
     * @param Comas $comas
     * @return array
     */
    public function getBigTest($lang, $grade_id, Comas $comas)
    {
        $comas = $comas->getBigTest($lang, $grade_id);
        if (!$comas) {
            return $this->result(false, 'Not found data');
        }
        return $this->result(true, 'Coma questions download success', $comas);

    }
}
