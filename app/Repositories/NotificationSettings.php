<?php

namespace App\Repositories;

use App\Models\Language;
use App\Models\NotificationSetting;
use Illuminate\Support\Facades\DB;
use App\Libs\Constants\Constant;

/**
 * This class manage all action of NotificationSettings
 * Class NotificationSettings
 * @package App\Repositories
 */
class NotificationSettings extends Repository
{
    /**
     * NotificationSettings constructor.
     */
    public function __construct()
    {
        parent::__construct(new NotificationSetting());
    }

    /**
     * This function get all Notification
     * @param $lang
     * @return mixed
     */
    public function get($lang)
    {
        return DB::table('notification_settings')
            ->join('languages', 'languages.id', '=', 'notification_settings.language_id')
            ->where('languages.lang_code', $lang)
            ->select(
                'notification_1_setting',
                'notification_2_setting',
                'notification_3_setting',
                'notification_4_setting',
                'notification_1_description',
                'notification_2_description',
                'notification_3_description',
                'notification_4_description',
                'notification_settings.updated_at AS date'
            )
            ->get();

    }

    /**
     * @param $fireBase
     * @return bool
     */
    public function checkFireBase ($fireBase)
    {
        return !empty($fireBase) ? true : false;
    }

    /**
     * This function get all Notification By Languages
     * @return array
     */
    public function getByLang()
    {
        $notification_settings = NotificationSetting::all();
        $arr_notification_settings = [];
        foreach ($notification_settings as $key => $notification_setting){
            $lang_codes = Language::find($notification_setting->language_id);
            $lang_code =(count($lang_codes)>0) ? $lang_codes->lang_code : '';
            $arr_notification_settings[$lang_code.'_id'] = $notification_setting->id;
            $arr_notification_settings[$lang_code.'_notification_1_description'] = $notification_setting->notification_1_description;
            $arr_notification_settings[$lang_code.'_notification_2_description'] = $notification_setting->notification_2_description;
            $arr_notification_settings[$lang_code.'_notification_3_description'] = $notification_setting->notification_3_description;
            $arr_notification_settings[$lang_code.'_notification_4_description'] = $notification_setting->notification_4_description;
            if($lang_code=='ja'){
                $arr_notification_settings['notification_1_term'] = $notification_setting->notification_1_term;
                $arr_notification_settings['notification_2_term'] = $notification_setting->notification_2_term;
                $arr_notification_settings['notification_3_term'] = $notification_setting->notification_3_term;
                $arr_notification_settings['notification_4_term'] = $notification_setting->notification_4_term;
                $arr_notification_settings['notification_1_setting'] = $notification_setting->notification_1_setting;
                $arr_notification_settings['notification_2_setting'] = $notification_setting->notification_2_setting;
                $arr_notification_settings['notification_3_setting'] = $notification_setting->notification_3_setting;
                $arr_notification_settings['notification_4_setting'] = $notification_setting->notification_4_setting;
            }

        }
        return $arr_notification_settings;
    }

    /**
     * This function update notification setting
     * @param $inputs
     */
    public function updateNotificationSetting( $inputs)
    {
        $languages = Language::all();
        if(count($languages)>0){
            foreach ($languages as $key => $language)
            {
                $lang_code = $language->lang_code;
                if(isset($inputs[$lang_code.'_id'])){
                    $notification_setting = NotificationSetting::find($inputs[$lang_code.'_id']);
                }else{
                    $notification_setting = new NotificationSetting();
                }
                $notification_setting->language_id = $language->id;
                $notification_setting->notification_1_term = isset($inputs['notification_1_term']) ? $inputs['notification_1_term']: 1;
                $notification_setting->notification_2_term = isset($inputs['notification_2_term']) ? $inputs['notification_2_term']: 7;
                $notification_setting->notification_3_term = isset($inputs['notification_3_term']) ? $inputs['notification_3_term']: 15;
                $notification_setting->notification_4_term = isset($inputs['notification_4_term']) ? $inputs['notification_4_term']: 30;
                $notification_setting->notification_1_setting = isset($inputs['notification_1_setting']) ? 1 : 0;
                $notification_setting->notification_2_setting = isset($inputs['notification_2_setting']) ? 1 : 0;
                $notification_setting->notification_3_setting = isset($inputs['notification_3_setting']) ? 1 : 0;
                $notification_setting->notification_4_setting = isset($inputs['notification_4_setting']) ? 1 : 0;
                $notification_setting->notification_1_description = isset($inputs[$lang_code.'_notification_1_description']) ? $inputs[$lang_code.'_notification_1_description']: '';
                $notification_setting->notification_2_description = isset($inputs[$lang_code.'_notification_2_description']) ? $inputs[$lang_code.'_notification_2_description']: '';
                $notification_setting->notification_3_description = isset($inputs[$lang_code.'_notification_3_description']) ? $inputs[$lang_code.'_notification_3_description']: '';
                $notification_setting->notification_4_description = isset($inputs[$lang_code.'_notification_4_description']) ? $inputs[$lang_code.'_notification_4_description']: '';
                $notification_setting->save();
            }
        }
    }

}