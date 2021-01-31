<?php

namespace App\Repositories;

use App\Models\Collection;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
use App\Libs\Constants\Constant;

/**
 * This class manage all function of Trophies
 * Class Trophies
 * @package App\Repositories
 */
class Trophies extends Repository
{
    public function __construct()
    {
        parent::__construct(new Collection());
    }

    /**
     * This function get content type of grade
     * @param $gradeId
     * @return string
     */
    protected function getContentTypeGrade($gradeId)
    {
        $checkType = DB::table('grades')
            ->where('grades.id', $gradeId)
            ->select('grades.content_type as content_type')
            ->first()->content_type;
        return $checkType;

    }

    /**
     * This function get trophy by type
     * @param $lang
     * @param $gradeId
     * @param $type
     * @return mixed
     */

    private function getTrophyByType($lang, $gradeId, $type)
    {
        $result = DB::table('grades')
            ->where('grades.id', $gradeId)
            ->join('collections', 'collections.grade_id', '=', 'grades.id')
            ->join('languages', 'languages.id', '=', 'collections.language_id')
            ->where('languages.lang_code', $lang)
            ->where('collections.level_id', $type)
            ->select(
                'collections.name as name',
                'collections.id as id',
                'collections.grade_id as grade_id',
                'collections.youtube_link as video_link',
                'collections.image_path as picture_link',
                'collections.description as description',
                'collections.type_id as pass'
            )
            ->get();
        return $result;
    }

    /**
     * This function get all Trophy
     * @param $lang
     * @return array
     */
    public function getTrophy($lang, $gradeId)
    {
        if ((int)$this->getContentTypeGrade($gradeId) != Constant::CONTENT_TYPE_GRADE_COMA) {
            return false;
        } else {
            $result = array(
                'trophies' => $this->getTrophyByType($lang, $gradeId, Constant::TYPE_TROPHY),
                'parts' => $this->getTrophyByType($lang, $gradeId, Constant::TYPE_PART)
            );
            return $result;
        }
    }

    /**
     * This function get all Part
     * @param $lang , $gradeId
     * @return array
     */
    public function getPart($lang, $gradeId)
    {
        $result = $this->getTrophyByType($lang, $gradeId, Constant::TYPE_PART);
        return $result;
    }

    /**
     * This function get all Card
     * @param $lang , $gradeId
     * @return array
     */
    public function getCard($lang, $gradeId)
    {
        $result = $this->getTrophyByType($lang, $gradeId, Constant::TYPE_CARD);
        return $result;
    }

    /**
     * This function get all Complete
     * @param $lang
     * @param $gradeId
     * @return array
     */
    public function getComplete($lang, $gradeId)
    {
        $result = $this->getTrophyByType($lang, $gradeId, Constant::TYPE_COMPLETE);
        return $result;
    }
}