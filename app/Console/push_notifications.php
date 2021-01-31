<?php

/**
 * Send mobile notification request for both iOS and Android
 *
 * @param $title string The title of notification
 * @param $body string The content of notification
 * @param $user_device_key string A generated unique token corresponds to the end user's mobile device
 * @param $user_device_type string 'iOS' or 'Android' or 'Both'
 * @param $link string The notification URL (Push Notification custom format)
 * @return bool true: Success; false: Failure
 */
function send_mobile_notification_request($title, $body, $user_device_key, $user_device_type = 'iOS', $link = '')
{
    // By default
    $result = -1;
    if ($user_device_type == 'iOS') {
        $result = push_notification_iOS($title, $body, $user_device_key, $link);
    } else if ($user_device_type == 'Android') {
        $result = push_notification_Android($title, $body, $user_device_key, $link);
    }
    return $result > 0 ? true : false;
}

/**
 * Send mobile notification request to APNS server (for iOS apps)
 *
 * @param $title
 * @param $body
 * @param $user_device_key
 * @param $link string The notification URL (Push Notification custom format)
 * @return bool|int
 */
function push_notification_iOS($title, $body, $user_device_key, $link = '')
{
    // In the testing phase OR production ?
    define('MODE', 'production'); // development

    // (iOS) Private key's passphrase
    define('PASS_PHRASE', '1234');

    // Apple server listening port
    $apns_port = 2195;
    $payload_info = _create_payload_json($title, $body, $link);
    
    if (MODE == "production") {
        $apns_url = 'gateway.push.apple.com';
        $apns_cert = __DIR__ . '/cert-prod.pem';
    } else {
        $apns_url = 'gateway.sandbox.push.apple.com';
        $apns_cert = __DIR__ . '/cert-dev.pem';
    }
    $stream_context = stream_context_create();
    stream_context_set_option($stream_context, 'ssl', 'local_cert', $apns_cert);
    stream_context_set_option($stream_context, 'ssl', 'passphrase', PASS_PHRASE);
    $apns = stream_socket_client('ssl://' . $apns_url . ':' . $apns_port, $error, $error_string, 2, STREAM_CLIENT_CONNECT, $stream_context);

    //$apns_message = chr(0) . chr(0) . chr(32) . pack('H*', str_replace(' ', '', $user_device_key)) . chr(0) . chr(strlen($payload_info)) . $payload_info;
    $apns_message = chr(0) . pack('n', 32) . pack('H*', str_replace(' ', '', $user_device_key)) . pack('n', strlen($payload_info)) . $payload_info;

    $result = $apns ? fwrite($apns, $apns_message) : -1;
    @socket_close($apns);
    @fclose($apns);

    // Return notification result
    return $result;
}

/**
 * Send mobile notification request to FCM server (for Android apps)
 *
 * @param $title
 * @param $body
 * @param $user_device_key
 * @param $link string The notification URL (Push Notification custom format)
 * @return mixed
 */
function push_notification_Android($title, $body, $user_device_key, $link = '')
{
    // API access key from Google API's Console
    define('API_ACCESS_KEY', 'AAAAroERKWw:APA91bFD7awwKa4EW4Zpd6fKyrHr6Pza_2wl9w5SejLSueY_vPLev2hMz477XvolXBIISeTrNEChyQFEuiAw6Y1DMf4B5zdSDKVkj_yfT2XdzysaO0cYZVia9nHoeitqkqe1Lm7moPTY');

    $requestUrl = 'https://fcm.googleapis.com/fcm/send';
    $message = array(
        'title' => $title,
        'body' => $body,
        'link' => $link,
        'icon' => 'myicon',/*Default Icon*/
        'sound' => 'mySound'/*Default sound*/
    );
    $headers = array(
        'Authorization: key=' . API_ACCESS_KEY,
        'Content-Type: application/json'
    );
    $fields = array(
        'to' => $user_device_key,
        'data' => $message,
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $requestUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);

    // Return notification result
    return $result;
}

/**
 * Build the message body for iOS notification
 *
 * @param $title string The title of notification
 * @param $body string The content of notification
 * @param $link string The notification URL (Push Notification custom format)
 * @return string
 */
function _create_payload_json($title, $body, $link)
{
    // Badge icon to show at users ios app icon after receiving notification
    $badge = "0";
    $sound = 'default';
    $payload = array();
    $payload['aps'] = array(
        'alert' => array(
            'title' => $title,
            'body' => $body
        ),
        'link' => $link,
        'badge' => intval($badge),
        'sound' => $sound
    );

    return json_encode($payload, true);
}