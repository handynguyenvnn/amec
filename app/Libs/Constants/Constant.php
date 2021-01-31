<?php
namespace App\Libs\Constants;

use Illuminate\Http\Request;

class Constant
{
    const TITLE_XML = '<&#63xml version="1.0" standalone="yes"&#63>';
    const BASE_URL = 'http://amec.adnet.space/';
    const S3_URL = 'https://s3-ap-northeast-1.amazonaws.com';
    const S3_BUCKET_URL = 'amec2017';
    const S3_CATEGORY_IMAGE = 'image';
    const NO_IMAGE = 'http://amec.adnet.space/img/default/no-image.jpg';
    const NO_MUSIC = 'http://amec.adnet.space/img/default/no-audio.jpg';
    const NO_VIDEO = 'http://amec.adnet.space/img/default/no-video.jpg';
    const FIRST_TIME_TRUE = 1;
    const FIRST_TIME_FALSE = 0;
    const PASSED = 1;
    const TYPE_CARD = 1;
    const TYPE_COMPLETE = 2;
    const TYPE_PART = 3;
    const TYPE_TROPHY = 4;
    const COMA = 1;
    const CONTENT_TYPE_GRADE = [ 'チュートリアル', 'ノーマル'];
    const CONTENT_TYPES = ['グレード', 'チャプタ', 'コマ', '小テスト問題', '大テスト'];
    const CONTENT_TYPE_GRADE_IS_COMA = 1;
    const CONTENT_TYPE_GRADE_IS_TUTORIAL = 0;
    const LANG_JA_ID = 1;
    const LANG_EN_ID = 2;
    const LANG_VN_ID = 3;
    const VALUE_ZERO = 0;
    const CONTENT_TYPE_GRADE_COMA = 1;
    const CATEGORY_MESSAGE = ['メッセージ (小テスト)', 'メッセージ（大テスト)', 'メッセージ（TIPS)'];
    const CATEGORY_MESSAGE_SMALL_TEST_CODE = 0;
    const CATEGORY_MESSAGE_BIG_TEST_CODE = 1;
    const CATEGORY_MESSAGE_TIPS_CODE = 2;
    const ON_OFF =['OFF','ON'];
    const QUESTION_FORMAT_QUESTIONS = ['択一問題', '複数選択問題'];
    const QUESTION_FORMAT = ['ランダム形式', '固定形式'];
    const OPTION_DISPLAY_FORMAT = ['ランダム形式', '固定形式'];
    const OPTION_VALUE_FIRST = 1;
    const OPTION_VALUE_SECOND = 2;
    const OPTION_VALUE_THIRD = 3;
    const OPTION_VALUE_FOURTH = 4;
    const NOT_AVAILABLE = 'N/A';
    const PUBLISHED = 1;
    const UNPUBLISH = 0;
    const STATUS_NO_TEST = 0;
    const STATUS_TEST_NO_PASS = 2;
    const STATUS_TEST_PASS = 3;
    const IOS_MOBILE_PLATFORM = 1;
    const ANDROID_MOBILE_PLATFORM = 0;
    const PRIORITY_CHECK_ON = 1;
    const PRIORITY_CHECK_OFF = 0;
    const LEVEL_ID_1 = 1;
    const LEVEL_ID_2 = 2;
    const LEVEL_ID_3 = 3;
    const LEVEL_ID_4 = 1;
}