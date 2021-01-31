<?php

require_once 'push_notifications.php';

$link = 'https://vnexpress.net/';

// TEST for Android
$title = "テスト";

$body = "テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテ";
$device_id = 'eUonCMXePBM:APA91bFyObcZQAJDVgJzE3rrg2-zSl0QtJuyWFiGTwMm9wabki7iEDtn7MSNZM_6AC6I92wn7DFkuH4UbDCj5fW-UiFU3oyq40-kYJyUrb6-AkuMS-t_ACvAmeE0i6iilnxEakmHQaqV';
for ($i = 0; $i < 6; $i++) {
	$result = push_notification_Android($title, $body, $device_id, $link);
	var_dump($result);
}
// TEST for iOS
$device_id = '914e00b22e6d0ce5788aef0492a06535dc14e5a9c91ccb90225ee17f486b786c';
//$result = push_notification_iOS($title, $body, $device_id, $link);
//var_dump($result);