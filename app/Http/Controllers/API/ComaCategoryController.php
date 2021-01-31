<?php

namespace App\Http\Controllers\API;

use App\Repositories\ComaCategories;
use App\Repositories\Comas;
use Illuminate\Http\Request;
use App\Libs\ApiValidators\ComaCategoryValidator;
use App\Http\Controllers\Controller;
use App\Libs\ApiValidators\GradeValidator;
use App\Libs\Constants\Constant;

/**
 * This class manage all function of coma
 * Class ComaController
 * @package App\Http\Controllers\API
 */
class ComaCategoryController extends ApiController
{
    public function postLangIdAndGetList(Request $request, ComaCategories $comaCategories)
    {
        $validate = ComaCategoryValidator::validateRequest($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        $result = $comaCategories->get($request->language_id);

        if (count($result) >0) {
            return $this->result(true, 'Coma-categories list', $result);
        }
        return $this->result(true, 'Coma-categories not found');

    }

}
