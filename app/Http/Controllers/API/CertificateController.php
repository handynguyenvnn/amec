<?php

namespace App\Http\Controllers\API;

use App\Repositories\CertificateSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\User;
use App\Models\PossessionCertificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Libs\ApiValidators\CertificateValidator;
use App\Repositories\PossessionCertificates;

/**
 * This class manage all function of Certificate
 * Class CertificateController
 * @package App\Http\Controllers\API
 */
class CertificateController extends ApiController
{
    /**
     * @param Request $request
     * @param PossessionCertificates $possessionCertificates
     * @return array
     */
    public function post(Request $request, PossessionCertificates $possessionCertificates)
    {
        $validate = CertificateValidator::validateRequest($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        $userId = $this->getAuthenticatedUser()->id;
        $result = $possessionCertificates->post($userId, $request);
        if (!$result) {
            return $this->result(false, 'can not save to data', null, '407');
        } else {
            return $this->result(true, 'created successfully', $result, '201');
        }
    }
    public function save( PossessionCertificates $possessionCertificates)
    {
        $userId = $this->getAuthenticatedUser()->id;
        $result = $possessionCertificates->save($userId);
        if (!$result) {
            return $this->result(false, 'can not save to data', null, '407');
        } else {
            return $this->result(true, 'created successfully', $result, '200');
        }
    }
    public function getBackground( CertificateSettings $certificateSettings, Request $request)
    {
        $validate = CertificateValidator::validateRequestBackground($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        $result = $certificateSettings->getBackground($request->language_id);
        if (!$result) {
            return $this->result(false, 'can not find to data', null, '407');
        } else {
            return $this->result(true, 'successfully', $result, '201');
        }
    }
}
