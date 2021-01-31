<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'API'], function () {

    //1.User
    Route::group(['prefix' => 'user'], function () {

        // <domain>/api/v1/user/authenticate
        Route::post('authenticate', 'UserController@authenticate');

        // <domain>/api/v1/user/register
        Route::post('register', 'UserController@register');

        // <domain>/api/v1/user/update
        Route::middleware('jwt.auth')->post('update', 'UserController@update');
        // <domain>/api/v1/user/infor
        Route::middleware('jwt.auth')->get('info', 'UserController@info');
        // <domain>/api/v1/user/photo
        Route::middleware('jwt.auth')->post('photo', 'UserController@photo');
    });

    //2.Language
    Route::group(['prefix' => 'language'], function () {
        // <domain>/api/v1/language/all
        Route::get('all', 'LanguageController@getAll');
        Route::middleware('jwt.auth')->post('code', 'LanguageController@postLang');
    });
    //3.Tutorial
    Route::group(['prefix' => 'tutorial'], function () {

        // <domain>/api/v1/tutorial/tutorial
        Route::post('tutorial/{lang}', 'TutorialController@postTutorial');

        // <domain>/api/v1/tutorial/coma
        Route::get('coma/{lang}', 'TutorialController@getComa');
        // <domain>/api/v1/tutorial/question/ja/1
        Route::get('question/{lang}/{chapter_id}', 'TutorialController@getQuestion');

        // <domain>/api/v1/tutorial/answer
        Route::get('answer', 'TutorialController@getAnswer');
    });
    // 4.Terms
    Route::group(['prefix' => 'terms'], function () {
        // <domain>/api/v1/terms/
        //terms
        Route::get('terms/{lang}', 'TermController@getTerms');

    });
    // 5.Guides
    Route::group(['prefix' => 'guides'], function () {
        // <domain>/api/v1/terms/
        //terms
        Route::get('guides/{lang}', 'GuideController@getGuides');

    });
    // 5.Grade No token
    Route::group(['prefix' => 'grade'], function () {
        // <domain>/api/v1/grade/{lang}
        Route::get('show-no-token/{lang}', 'GradeController@showInformationNoToken');
    });
    // 6.Coma
    Route::group(['prefix' => 'coma'], function () {
        // <domain>/api/v1/coma/coma
        Route::post('coma/{lang}/{id}', 'ComaController@postComa');
        // <domain>/api/v1/coma/question
        Route::get('question/{lang}/{id}', 'ComaController@getQuestion');
        // <domain>/api/v1/coma/bigtest
        Route::get('bigtest/{lang}/{grade_id}', 'ComaController@getBigTest');
    });
    // 10.Advertisement
    Route::get('advertisement', 'AdvertisementController@getAds');
    // 11.Profession

    Route::get('profession-area/{lang}', 'ProfessionAreaController@getAll');

    Route::group(['middleware' => 'jwt.auth'], function () {

        //small-test
        Route::get('small-test/{lang}', 'SmallTestController@get');
        Route::get('small-test-list/{chapterId}', 'SmallTestController@listAll');
        Route::get('big-test/{lang}', 'BigTestController@get');

        // 6.chapters
        Route::group(['prefix' => 'chapters'], function () {
            // <domain>/api/v1/coma/coma
            Route::get('chapters/{lang}', 'ChapterController@getChapter');
            // <domain>/api/v1/coma/question
            Route::get('question/{lang}/{id}', 'ChapterController@getQuestion');
            // <domain>/api/v1/coma/bigtest
            Route::get('bigtest/{lang}/{grade_id}', 'ChapterController@getBigTest');
        });

        // 5.Grade
        Route::group(['prefix' => 'grade'], function () {
            // <domain>/api/v1/grade/{lang}
            Route::get('show/{lang}', 'GradeController@showInformation');
        });

        // 7.Trophy
        Route::group(['prefix' => 'trophy'], function () {
            // <domain>/api/v1/trophy/trophy
            Route::get('trophy/{lang}/{grade_id}', 'TrophyController@getTrophy');
            Route::get('part/{lang}', 'TrophyController@getPart');
            Route::get('card/{lang}', 'TrophyController@getCard');
            Route::get('complete/{lang}', 'TrophyController@getComplete');
        });
        // 8.Collection
        Route::group(['prefix' => 'collection'], function () {
            // <domain>/api/v1/collection/collection
            Route::get('collection/{lang}', 'CollectionController@getCollection');
            // <domain>/api/v1/collection/post
            Route::get('post/{lang}', 'CollectionController@saveCollection');
            // <domain>/api/v1/collection/post
            Route::get('remove/{collection_id}', 'CollectionController@removePossessionCollection');
        });
        // 9.Tip
        Route::group(['prefix' => 'tips'], function () {
            // <domain>/api/v1/lesson/lesson
            Route::get('coma/{lang}', 'TipsController@getComa');
            Route::get('question/{lang}', 'TipsController@getQuestion');
            Route::post('tips/{lang}', 'TipsController@postTip');
        });
        // 11.PartSave
        Route::post('partsave/{id}', 'PartController@postPart');
        // 12.Certificate
        Route::group(['prefix' => 'certificate'], function () {
            Route::post('{id}', 'CertificateController@post');
            Route::get('save', 'CertificateController@save');
            Route::get('background', 'CertificateController@getBackground');
        });
        Route::post('certificate-background', 'CertificateController@getBackground');
        // 13.Check
        Route::group(['prefix' => 'check'], function () {
            // <domain>/api/v1/check/projectdate
            Route::post('projectdate', 'CheckController@checkProjectDate');
            // <domain>/api/v1/check/gradedate
            Route::post('gradedate', 'CheckController@checkGradeDate');
            // <domain>/api/v1/check/state
            Route::post('state', 'CheckController@checkState');

        });
        // 14.coma-categories
         Route::post('coma-categories','ComaCategoryController@postLangIdAndGetList');
         //15 : big test history
        Route::post('bigtest-history','BigTestController@post');
        //15 : smalltest history
        Route::post('smalltest-history','SmallTestController@post');
        //16 : Chapter history
        Route::post('chapter-history','ChapterController@post');
        //16 : App history
        Route::post('app-history','AppController@post');

    });
    // 15.Notification
    Route::group(['prefix' => 'notification'], function () {
        Route::get('get/{lang}', 'NotificationController@get');
        Route::post('post/{lang}', 'NotificationController@post');
    });
    // 16.coma-categories
    Route::get('announcements/{lang}','AnnouncementController@get');
});