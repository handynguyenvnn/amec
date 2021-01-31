<?php

namespace App\Repositories;

use App\Http\Controllers\CertificateSettingController;
use App\Libs\Constants\Constant;
use App\Models\Certificate;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * This class manage all action of CertificateSettings
 * Class NotificationSettings
 * @package App\Repositories
 */
class CertificateSettings extends Repository
{
    /**
     * Certificate constructor.
     */
    public function __construct()
    {
        parent::__construct(new Certificate());
    }

    /**
     * This function get certificate settings with language
     * @return mixed
     */
    public function getCertificateSettingsWithLanguage()
    {
        $results = Certificate::all();
        $arrCertificate = [];
        foreach ($results as $key => $result) {
            $lang = Language::find($result->language_id);
            $lang_code = (count($lang) > 0) ? $lang->lang_code : '';
            $arrCertificate[$lang_code . '_id'] = $result->id;
            $arrCertificate[$lang_code . '_image_path'] = Constant::S3_URL . DS . Constant::S3_BUCKET_URL . DS . $result->image_path;
        }
        return $arrCertificate;
    }

    /**
     * @param $id
     * @return string
     */
    public function getCertificateSetting($id)
    {
        $result = Certificate::find($id);
        return $result;
    }
    public function updateCertificateSetting( $requests ){
        $languages = Language::all();
        if(count($languages)>0) {
            foreach ($languages as $key => $language) {
                if (isset($requests[$language->lang_code.'_id'])){
                    $certificateSetting = Certificate::find($requests[$language->lang_code.'_id']);
                }else{
                    $certificateSetting = new Certificate();
                }
                $certificateSetting->language_id = $language->id;
                if (isset($requests[$language->lang_code.'_image_path'])) {
                    $image_path = $requests[$language->lang_code.'_image_path'];
                    $nameImage = str_random(15) . pathinfo($image_path)['filename'];
                    $extImage = $image_path->guessClientExtension();
                    if (Storage::disk('s3')->putFileAs('image/common', $image_path, "{$nameImage}.{$extImage}", "public")) {
                        $certificateSetting->image_path = 'image/common' . DS . $nameImage . '.' . $extImage;
                    } else {
                        $certificateSetting->image_path = Constant::NO_IMAGE;
                    }
                }
                 $certificateSetting->save();
            }

        }
    }
    public function getBackground($langId){
        $certificate = Certificate::where('language_id', $langId)->first();
        return (count($certificate)>0) ? Constant::S3_URL . DS . Constant::S3_BUCKET_URL . DS . $certificate->image_path : '';
    }

}