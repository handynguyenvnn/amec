<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\User;
use App\Models\PossessionCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Libs\ApiValidators\PartValidator;
use App\Repositories\Parts;
use App\Libs\Constants\Constant;

/**
 * This class manage all function of Parts
 * Class PartController
 * @package App\Http\Controllers\API
 */
class PartController extends ApiController
{
    /**
     * This function save part to database
     * @param Request $request Parts $parts
     * @return mixed
     */
    public function postPart(Request $request, Parts $parts)
    {
        $validate = PartValidator::validateRequest($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        $userId = $this->getAuthenticatedUser()->id;
        $collectionId = $request->collection_id;
        if ($request->pass == Constant::PASSED) {
            $result = $parts->savePart($userId, $collectionId);
            if ($result) {
                return $this->result(false, 'can not save to data', null, '407');
            } else {
                return $this->result(true, 'created successfully', $result, '201');
            }
        } else {
            $result = $parts->destroyPart($userId, $collectionId);
            if (!$result) {
                return $this->result(false, 'Can not delete data', null, '407');
            } else {
                return $this->result(true, 'Delete successfully', $result, '201');
            }

        }

    }
}
