<?php

namespace App\Http\Controllers\API;

use App\Repositories\Chapters;
use App\Repositories\Comas;
use Illuminate\Http\Request;
use App\Libs\ApiValidators\ChapterValidator;
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
class ChapterController extends ApiController
{
    /**
     * @param $lang
     * @param Chapters $chapters
     * @return array
     */
    public function getChapter( $lang, Chapters $chapters)
    {
        $userId = JWTAuth::parseToken()->authenticate()->id;
        return $this->result(true, 'Chapter', $chapters->getChapter( $lang, $userId ));
    }

    public function post( Request $request, Chapters $chapters){
        $validate = ChapterValidator::validateRequest($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        $userId = JWTAuth::parseToken()->authenticate()->id;
        $results = $chapters->postHistory($request->id, $request->completion_flg, $userId);
        if(!$results) {
            return $this->result(false, 'Not post data');
        }
        return $this->result(true, 'post success', $results);

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
        return $this->result(true, 'Coma Big Test download success', $comas);

    }
}
