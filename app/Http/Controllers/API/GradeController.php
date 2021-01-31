<?php

namespace App\Http\Controllers\API;

use App\Repositories\Grades;
use Illuminate\Http\Request;
use App\Libs\ApiValidators\GradeValidator;
use App\Libs\Constants\Constant;
use JWTAuth;
use Hash;

/**
 * This class manage all function of grade
 * Class GradeController
 * @package App\Http\Controllers\API
 */
class GradeController extends ApiController
{
    /**
     * Get all grades by language code
     * @param $lang
     * @param Grades $grades
     * @return array
     */
//    public function showInformation(Request $request, $lang, Grades $grades)
    public function showInformation( $lang, Grades $grades)
    {
        $userId = JWTAuth::parseToken()->authenticate()->id;
        $grades = $grades->getGrade($lang, $userId);
        if (count($grades)) return $this->result(true, 'grade updated ', $grades);
        else return $this->result(false, 'false', $grades);
    }
    public function showInformationNoToken($lang, Grades $grades){
        $userId = null;
        $grades = $grades->getGrade($lang, $userId);
        if (count($grades)) return $this->result(true, 'grade updated ', $grades);
        else return $this->result(false, 'false', $grades);
    }
}
