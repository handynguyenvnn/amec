<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\NotificationSetting;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\NotificationSettings;
use Illuminate\Support\Facades\Storage;


class NotificationSettingController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param NotificationSettings $notificationSettings
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index( NotificationSettings  $notificationSettings)
    {
        $data = $notificationSettings->getByLang();
        $languages = Language::all();
        return view('notification_setting.list', compact('data','keyword', 'term', 'languages'));
    }

    /**
     * @param Request $request
     * @param NotificationSettings $notificationSettings
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( Request $request, NotificationSettings $notificationSettings)
    {
       $notificationSettings->updateNotificationSetting($request->except('_token'));
        return redirect()->route('notification_settings.index');
    }


}
