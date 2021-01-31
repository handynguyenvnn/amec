<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Grade;
use App\Libs\ApiCheckDate\CheckDate;

use Illuminate\Support\Facades\DB;

/**
 * This class check date of project and grade
 * Class Checks
 * @package App\Repositories
 */

class Checks extends Repository
{
    /**
     * Checks constructor.
     */
    public function __construct()
    {

    }

    /**
     * This function check Project Date
     * @param $inputDate
     * @return boolean
     */
    public function checkProjectDate($inputDate)
    {
        $updateAt = strtotime(Project::select('updated_at')->get()[0]->updated_at);
        $inputDate = strtotime($inputDate);
        return CheckDate::compareTwoTimes($updateAt, $inputDate);
    }

    /**
     * This function check Project Date
     * @param $inputDate, $gradeId
     * @return boolean
     */
    public function checkGradeDate($inputDate, $gradeId)
    {
        $updateAt = strtotime(Grade::where('id', $gradeId)->select('updated_at')->get()[0]->updated_at);
        $inputDate = strtotime($inputDate);
        return CheckDate::compareTwoTimes($updateAt, $inputDate);
    }

    /**
     * @param $state
     * @return bool
     */
    public function checkState ($state)
    {
            return $state ? true : false;
    }

}