<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\NotificationSettings;
use Illuminate\Support\Facades\Notification;
use App\Libs\ApiValidators\NotificationSettingValidator;

/**
 * This class manage all function of Notifications
 * Class NotificationController
 * @package App\Http\Controllers\API
 */
class NotificationController extends ApiController
{
    /**
     * This function get notification
     *
     * @param NotificationSettings $notificationSettings
     * @param $lang
     * @return array
     */
    public function get(NotificationSettings $notificationSettings, $lang)
    {
        $result = $notificationSettings->get($lang);
        if (count($result)> 0) {
            return $this->result(true, 'Notification download success', $result[0]);
        }
        return $this->result(false, 'Not found data');

    }

    /**
     * @param NotificationSettings $notificationSettings
     * @param Request $request
     * @return array
     */
    public function post(NotificationSettings $notificationSettings,Request $request)
    {
        $validate = NotificationSettingValidator::validateRequest($request);
        if ($validate) {
            return $this->result(false, array('Input valid', $validate), null, '412');
        }
        if ($notificationSettings->checkFireBase($request->firebase_token)) {
            return $this->result(true, 'received successful file base token', null);
        } else {
            return $this->result(false, 'Not received', null);
        }
    }
}
