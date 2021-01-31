<?php
/**
 * Created by PhpStorm.
 * User: ChiNguyen
 * Date: 24/07/2017
 * Time: 17:52
 */
namespace App\Repositories;


use App\Models\PossessionCertificate;
use App\Models\User;

class PossessionCertificates extends Repository
{
    /**
     * PossessionAuthorities constructor.
     */
    public function __construct()
    {
        parent::__construct(new PossessionCertificate());
    }
    public function post( $userId, $request)
    {
        $dataSave = new PossessionCertificate();
        $dataSave->user_id = $userId;
        $dataSave->certificate_id = $request->certificate_id;
        $dataSave->issue_date = $request->issue_date;
        $dataSave->photo_path = $request->photo_path;
        if(!$dataSave->save()){
            return false;
        }
        else
        {
            return $dataSave;
        }
    }
    public function save($userId)
    {
        $possession_certificate = PossessionCertificate::where('user_id', $userId)
            ->first();
        if(count($possession_certificate)>0){
            $certificate  = PossessionCertificate::find($possession_certificate->id);
            $certificate->photo_path = User::find($userId)->user_photo;
            $certificate->save();
            $certificate->username = User::find($userId)->username;
            return $certificate;
        }else {
            $certificate = new PossessionCertificate();
            $certificate->user_id = $userId;
            $certificate->certificate_id = null;
            $certificate->issue_date = date('Y-m-d H:i:s');
            $certificate->photo_path = User::find($userId)->user_photo;
            $certificate->save();
            $certificate->username = User::find($userId)->username;
            return $certificate;
        }
    }

}
