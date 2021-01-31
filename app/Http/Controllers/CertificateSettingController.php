<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use App\Repositories\CertificateSettings;


class CertificateSettingController extends Controller
{

    /**
     * @param CertificateSettings $certificateSettings
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( CertificateSettings $certificateSettings)
    {
        $data = $certificateSettings->getCertificateSettingsWithLanguage();
        $languages = Language::all();
        return view('certificate_setting.list', compact('data','keyword', 'languages'));
    }

    /**
     * @param Request $request
     * @param CertificateSettings $certificateSettings
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( Request $request, CertificateSettings $certificateSettings)
    {
        $certificateSettings->updateCertificateSetting($request->except('_token'));
        return redirect()->route('certificate-settings.index');
    }

    /**
     * @param CertificateSettings $certificateSettings
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAjax( CertificateSettings $certificateSettings, $id)
    {
        $certificateSettings = $certificateSettings->getCertificateSetting($id);
        return response()->json(['certificate' => $certificateSettings]); // AJAX JS: response.terms_of_use
    }
    public function delete( $id)
    {
        Certificate::find($id)->delete();
        return redirect()->route('certificate-settings.index');
    }

}
