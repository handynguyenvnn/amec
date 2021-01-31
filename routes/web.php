<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
error_reporting(E_ALL & ~E_NOTICE);

// authentication
Route::get('login', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@postLogin')->name('postLogin');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/', 'HomeController@index')->name('home');          // home
    Route::post('logout', 'AuthController@logout')->name('logout'); // logout

    // 1.Account
    Route::resource('accounts', 'AccountController');
    // 2.Master
    Route::resource('master', 'MasterController');
    Route::get('/master-info/{id}', 'MasterController@info');
    // 3.Report Access
    Route::group(['prefix' => 'access-analysis'], function () {
        Route::get('/', 'ReportAccessController@index')->name('access-analysis.index');
        Route::get('/download-csv', 'ReportAccessController@download')->name('access-analysis.download');
        Route::get('/big-tests','ReportAccessController@bigTests')->name('access-analysis.big-tests');
        Route::get('/big-tests/download-csv','ReportAccessController@downloadBigTests')->name('access-analysis.big-tests.download');
        Route::get('/certifications','ReportAccessController@certifications')->name('access-analysis.certifications');
    });

    // 4.Content Management
    Route::resource('contents', 'ContentController');
    Route::post('/sortable/{_table}/{_field}/{_where?}', 'ContentController@sortable')->name('contents.sortable');
    Route::post('/grade/save', 'ContentController@save')->name('grades.save');

    // 5.Collection
    Route::resource('collections', 'CollectionController');
    Route::group(['prefix' => 'collection'], function () {
        Route::delete('/deleteImage/{no?}', 'CollectionController@deleteImage')->name('collections.deleteImage');
        Route::get('/action/{id?}', 'CollectionController@action')->name('collections.action');
        Route::get('/update/card-appearance-rate', 'CollectionController@updateCardAppearanceRate')->name('collections.card-appearance-rate');
    });
    Route::get('/collection-info/{id}', 'CollectionController@info');
    // 5.1 Makers
    Route::resource('makers', 'MakerController');
    Route::get('/makers/checkuse', 'MakerController@checkUse');
    // 5.2 Tags
    Route::resource('tags', 'TagController');
//    Route::get('/tags/checkuse', 'TagController@checkUse');

    // 6.Users
    Route::resource('users', 'UserController');
    Route::group(['prefix' => 'user'], function () {
        Route::get('/action/{id?}', 'UserController@action')->name('users.action');
        Route::post('/import', 'UserController@import')->name('users.import');
        Route::delete('/deleteImage/{id?}', 'UserController@deleteImage')->name('users.deleteImage');
        Route::get('/area/{language_id?}', 'UserController@area')->name('users.area');
        Route::get('/profession/{language_id?}', 'UserController@profession')->name('users.profession');
    });
    Route::get('/users-csv', 'UserController@download')->name('users-csv.download');
    Route::get('/users-import-excel', 'UserController@importUserExcel')->name('users-csv.import-excel');

    // 7.Announcements (News/Notices)
    Route::resource('announcements', 'AnnouncementController');
    Route::group(['prefix' => 'announcement'], function () {
        Route::get('/action/{id?}', 'AnnouncementController@action')->name('announcements.action');
        Route::get('/area/{language_id?}', 'AnnouncementController@area')->name('announcements.area');
    });

    // 8.Terms of service
    Route::group(['prefix' => 'terms_of_service'], function () {
        Route::get('/', 'TermController@index')->name('terms_of_service.index');
        Route::put('update','TermController@update')->name('terms_of_service.update');
        Route::get('/{id}','TermController@getAjaxTerm')->name('terms_of_service.getAjax');
    });

    // 9.Notification settings
    Route::group(['prefix' => 'notification_settings'], function () {
        Route::get('/', 'NotificationSettingController@index')->name('notification_settings.index');
        Route::put('update', 'NotificationSettingController@update')->name('notification_settings.update');
    });

    // 10.Certificate-settings
    Route::group(['prefix' => 'certificate_settings'], function () {
        Route::delete('delete/{id}', 'CertificateSettingController@delete')->name('certificate-settings.delete');
        Route::get('/', 'CertificateSettingController@index')->name('certificate-settings.index');
        Route::put('update', 'CertificateSettingController@update')->name('certificate-settings.update');
        Route::get('/{id}','CertificateSettingController@getAjax')->name('certificate-settings.getAjax');
    });

    // 11.Guides
    Route::group(['prefix' => 'guides'], function () {
        Route::get('/', 'GuideController@index')->name('guides.index');
        Route::put('update', 'GuideController@update')->name('guides.update');
        Route::get('/{id}','GuideController@getAjax')->name('guides.getAjax');
    });

    // 12.Coma categoriesput
    Route::resource('coma-categories', 'ComaCategoryController');
    Route::get('coma-category-get-by-no/{no}', 'ComaCategoryController@getByNo')->name('coma-categories.getByNo');
    Route::put('coma-category-store', 'ComaCategoryController@store')->name('coma-categories.store');
    Route::put('coma-category-update/{id}', 'ComaCategoryController@update')->name('coma-categories.update');

    // 13. Chapter
    Route::resource('chapters', 'ChapterController');
    Route::group(['prefix' => 'chapter'], function () {
        Route::get('/list/{gradeId?}/{versionId?}', 'ChapterController@listAll')->name('chapters.list');
        Route::get('/action/{gradeId?}/{versionId?}/{id?}', 'ChapterController@action')->name('chapters.action');
        Route::delete('/remove/{gradeId?}/{versionId?}/{id?}', 'ChapterController@remove')->name('chapters.remove');
        Route::delete('/removeComa/{gradeId?}/{versionId?}/{comaId?}/{id?}', 'ChapterController@removeComa')->name('chapters.removeComa');
        Route::delete('/removeSmallTest/{gradeId?}/{versionId?}/{smallTestId?}/{id?}', 'ChapterController@removeSmallTest')->name('chapters.removeSmallTest');
        Route::delete('/removeSmallTestQuestion/{gradeId?}/{versionId?}/{smallTestId?}/{id?}', 'ChapterController@removeSmallTestQuestion')->name('chapters.removeSmallTestQuestion');

        Route::get('/get-coma-by-ajax/{id}', 'ComaController@getChapterComaByAjax')->name('chapters.coma');
        Route::get('/search-coma-by-ajax/{coma}/{id}', 'ComaController@searchComaByAjax')->name('chapters.searchComa');
        Route::get('/delete-comas/{id}', 'ChapterController@destroyComa')->name('chapters.destroyComa');
        Route::post('/create-comas', 'ChapterController@createComa')->name('chapters.createComa');
        Route::post('/update-coma/{id}', 'ChapterController@updateComa')->name('chapters.updateComa');
        Route::get('/delete_image/{id}', 'ChapterController@deleteImage')->name('chapters.deleteImage');
        Route::get('/delete_video/{id}', 'ChapterController@deleteVideo')->name('chapters.deleteVideo');
        Route::get('/delete_audio/{id}', 'ChapterController@deleteAudio')->name('chapters.deleteAudio');
    });

    // 14. Messages
    Route::get('messages', 'MessageController@store')->name('messages.store');

    // 15. Comas
    Route::resource('comas', 'ComaController');

    // 16. Tips
    Route::resource('tips', 'TipController');

    // 17. Grades
    Route::resource('grades', 'GradeController');
    Route::group(['prefix' => 'grade'], function () {
        Route::put('/deleteImage/{id?}', 'GradeController@deleteImage')->name('grades.deleteImage');
        Route::get('/version/copy', 'GradeController@versionCopy');
        Route::post('/publish-version/{id}', 'GradeController@publishVersion')->name('grade.publish_version');
        Route::put('/delete-version/{id}', 'GradeController@deleteVersion')->name('grade.delete_version');
        Route::get('/my_page_background/{image}', function ($filename)
        {
            $path = storage_path('app').  DIRECTORY_SEPARATOR. 'my_page_background' .DIRECTORY_SEPARATOR . $filename;
            if (!File::exists($path)) {
                abort(404);
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            $response->header("Content-Type", $type);
            return $response;
        })->name('grade.my_page_background');


    });

    // 18. Advertisements
    Route::resource('advertisements', 'AdvertisementController');
    Route::get('advertisement/action', 'AdvertisementController@action')->name('advertisements.action');
    Route::delete('advertisement/delete/{id}', 'AdvertisementController@delete')->name('advertisements.delete');

    Route::resource('small-test-questions', 'SmallTestQuestionController');

    // 18. Small Tests
    Route::resource('small_tests', 'SmallTestController');
    Route::group(['prefix' => 'small_test_question'], function () {
        Route::get('/action/{gradeId?}/{versionId?}/{id?}', 'SmallTestController@action')->name('small_tests.action');
        Route::get('/get-by-ajax/{id}', 'SmallTestQuestionController@getByAjax');
        Route::get('/search-by-ajax/{name}/{id}', 'SmallTestQuestionController@searchByAjax')->name('small_tests.searchSmallTestQuestions');
        Route::get('/delete/{id}', 'SmallTestQuestionController@destroySmallTest')->name('small_test_question.destroy');
        Route::get('/remove/{id}', 'SmallTestQuestionController@destroySmallTestChoice')->name('small_test_question.destroyChoice');
        Route::post('/create', 'SmallTestQuestionController@create')->name('small_test_question.create');
        Route::post('/update/{id}', 'SmallTestQuestionController@update')->name('small_test_question.update');
        Route::get('/delete_image/{id}', 'SmallTestQuestionController@deleteImage')->name('small_test_question.deleteImage');
        Route::get('/delete_video/{id}', 'SmallTestQuestionController@deleteVideo')->name('small_test_question.deleteVideo');
        Route::get('/delete_image_choice/{id}', 'SmallTestQuestionController@deleteImageChoice')->name('small_test_question.deleteImageChoice');
    });
    // 19 . Card Appearance Rates
    Route::resource('card-appearance-rates', 'CardAppearanceRatesController');
    // 20 . User Histories
    Route::resource('user-histories', 'UserHistoryController');
    Route::group(['prefix' => 'user-history'], function () {
        Route::get('/{id}/chapters', 'UserHistoryController@chapters')->name('user-history.chapters');
        Route::get('/{id}/bigtests', 'UserHistoryController@bigTests')->name('user-history.bigtests');
        Route::get('/{id}/apptimes','UserHistoryController@appTimes')->name('user-history.apptimes');

    });
    // 21. Chat Tools
    Route::resource('chat-tools', 'ChatToolController');


    // 22. XML Data
    Route::group(['prefix' => 'xmls'], function () {
	    Route::get('/db/{table_name}', 'XmlsController@db')->name('xmls.db.update');
        Route::get('/input', 'XmlsController@input')->name('xmls.input');

        Route::get('/import', 'XmlsController@import')->name('xmls.import');
        Route::post('/import', 'XmlsController@import');

        Route::get('/export', 'XmlsController@export')->name('xmls.export');
        Route::post('/export', 'XmlsController@export');

        Route::get('/delete/{id}', 'XmlsController@deleteXML')->name('xmls.delete');
        Route::get('/download/{xml}', function($xml = null)
        {
            $path = storage_path('app').  DIRECTORY_SEPARATOR. 'xml' .DIRECTORY_SEPARATOR . $xml;
            if (file_exists($path)) {
                return Response::download($path);
            }
        })->name('xmls.download');
    });
});


