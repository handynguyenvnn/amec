<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\ApiValidators\ProjectValidator;
use App\Libs\ApiValidators\GradeValidator;
use App\Repositories\Checks;

/**
 * This class manage all function of check
 * Class CheckController
 * @package App\Http\Controllers\API
 */
class CheckController extends ApiController
{
    /**
     * This function check project date
     * @param Request $request , Checks $checks
     * @return array
     */
    public function checkProjectDate(Request $request, Checks $checks)
    {
        $validate = ProjectValidator::validateRequest($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        if (!$checks->checkProjectDate($request->input_date)) {
            return $this->result(false, 'help', false);
        } else {
            return $this->result(true, 'help', true);
        }
    }

    /**
     * This function check project date
     * @param Request $request , Checks $checks
     * @return array
     */
    public function checkGradeDate(Request $request, Checks $checks)
    {
        $validate = GradeValidator::validateRequest($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        if (!$checks->checkGradeDate($request->input_date, $request->grade_id)) {
            return $this->result(false, 'help', false);
        } else {
            return $this->result(true, 'help', true);
        }
    }

    /**
     * @param Request $request
     * @param Checks $checks
     * @return array
     */
    public function checkState(Request $request, Checks $checks)
    {
        $validate = GradeValidator::validateRequestState($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        if (!$checks->checkState($request->state)) {
            return $this->result(false, 'help', false);
        } else {
            return $this->result(true, 'help', true);
        }
    }
}