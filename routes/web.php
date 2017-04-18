<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'locker'], function () {
        Route::get('/', function () {
            return redirect()->route('dashboard');
        });

        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('details/college/{id}', 'CollegeController@getCollegeDetails')->name('view_college_details');
            Route::post('search', 'FunctionalController@search')->name('search');

            /* Colleges Page */
            Route::get('college', 'HomeController@getColleges')->name('colleges');
            Route::group(['prefix' => 'college'], function () {
                Route::get('view/{id}', 'HomeController@getCollegeTimeline')->name('view_colleges');
                Route::get('change/{id}', 'HomeController@getChangeColleges')->name('change_colleges');
                Route::post('change/{id}/check', 'CollegeController@postChangeCollege')->name('save_change_colleges');
                Route::get('change/{id}/check/selection/{collegename?}/{collegelocation?}', 'CollegeController@getChangeAssessorsSelection')->name('change_college_assessors');
                Route::get('add', 'HomeController@getAddNewCollege')->name('add_college');
                Route::post('add/save', 'CollegeController@postNewCollege')->name('save_new_college');

                Route::get('save/assessor/{id}/{collegeid}', 'FunctionalController@ajaxSaveAssessorToCollege')->name('ajax_save_college_by_selection');
                Route::get('save/{id}/{name}', 'FunctionalController@ajaxSaveCollege')->name('ajax_save_college');
            });


            /* Teamleaders Page */
            Route::get('teamleaders', 'HomeController@getTeamleaders')->name('teamleaders');
            Route::group(['prefix' => 'teamleader'], function () {
                Route::get('view/{id}', 'HomeController@getTeamleaderTimeline')->name('view_teamleaders');
                Route::get('change/{id}', 'HomeController@getChangeTeamleader')->name('change_teamleaders');
                Route::post('change/{id}/check', 'TeamleaderController@postChangeTeamleader')->name('save_change_teamleaders');

                Route::get('add/', 'HomeController@getAddTeamleader')->name('add_teamleader');
                Route::post('add/manual/save/{count?}', 'TeamleaderController@postAddTeamleaderManual')->name('add_teamleader_manual_save');
                Route::get('add/manual/exchange/', 'TeamleaderController@getChangeTeamleaderManual')->name('add_teamleader_change_save');
                Route::post('add/manual/exchange/save/{count?}', 'TeamleaderController@postChangeTeamleaderManual')->name('add_teamleader_change_save_exchange');

                Route::get('save/{id}/{name}', 'FunctionalController@ajaxSaveTeamleader')->name('ajax_save_teamleader');
            });


            /* Assessors Page */
            Route::get('assessors', 'HomeController@getAssessors')->name('assessors');
            Route::group(['prefix' => 'assessor'], function () {
                Route::get('profile/{id}', 'HomeController@getAssessorProfile')->name('view_assessor_profiel');
                Route::get('view/{id}', 'HomeController@getAssessorTimeline')->name('view_assessor');
                Route::get('change/{id}', 'HomeController@getChangeAssessor')->name('change_assessor');
                Route::post('change/{id}/check', 'AssessorController@postChangeAssessor')->name('save_change_assessor');

                Route::get('add/', 'HomeController@getAddAssessor')->name('add_assessor');
                Route::get('add/manual', 'HomeController@getAddAssessorManual')->name('add_assessor_manual');
                Route::post('add/manual/save/{count?}', 'AssessorController@postAddAssessorManual')->name('add_assessor_manual_save');
                Route::get('add/automatic', 'HomeController@getAddAssessorAutomatic')->name('add_assessor_automatic');
                Route::get('excel/layout/download', 'FunctionalController@downloadExcelAssessorLayout')->name('download_excel_assessor_layout');
                Route::post('add/automatic/save', 'AssessorController@postAddAssessorAutomatic')->name('add_assessor_automatic_save');
                Route::get('add/automatic/undo/{id}', 'AssessorController@getUndoAssessorAutomatic')->name('add_assessor_automatic_undo');
            });

        });

        Route::group(['prefix' => 'maintenance'], function () {
            Route::get('overview', 'HomeController@getAssessorMaintenance')->name('maintenance_assessor');
            Route::get('groups', 'HomeController@getAssessorMaintenanceGroup')->name('maintenance_assessor_groups');
            Route::get('groups/add', 'AssessorMaintenanceController@getMakeNewGroup')->name('add_new_assessor_groups');
            Route::get('groups/remove/{id}', 'AssessorMaintenanceController@getRemoveGroup')->name('remove_assessor_group');

            Route::post('groups/place/assessor', 'AssessorMaintenanceController@postPlaceAssessor')->name('post_maintenance_assessor_groups');
            Route::post('save/data', 'AssessorMaintenanceController@postMaintenanceData')->name('post_maintenance_data');
            Route::post('tick/maintenance', 'AssessorMaintenanceController@postTickMaintenance')->name('post_tick_maintenance');
        });

        Route::group(['prefix' => 'notifications'], function () {
            Route::get('overview', 'HomeController@getNotifications')->name('notification_overview');
            Route::get('overview/show/{id}', 'HomeController@getNotification')->name('notification_view');
            Route::get('create', 'HomeController@getCreeateNotifications')->name('notification_create');
            Route::post('save', 'NotificationController@postSaveNotification')->name('notification_save');
        });

        /* Dashboard Page */
        Route::get('/dashboard/{year?}', 'HomeController@getDashboard')->name('dashboard');
        Route::get('/history/data/get', 'FunctionalController@ajaxGetHistoryData')->name('ajax_history_data_get');
        Route::get('/assessor/data/get', 'FunctionalController@ajaxGetAssessorData')->name('ajax_assessor_data_get');

        /* Administrator page*/
        Route::get('/users', 'HomeController@getUsers')->name('users');
        Route::get('/users/new', 'HomeController@getNewUsers')->name('add_users');
        Route::post('/users/new', 'UserController@postNewAdmin')->name('new_user');

        /*INDEPENDENT ROUTES*/
        Route::get('bookmark/history', 'FunctionalController@makeBookmark')->name('create_bookmark');

        /* AJAX INDEPENDENT ROUTES */
        Route::get('/ajax/get/colleges/{option}', 'FunctionalController@ajaxGetColleges')->name('ajax_get_colleges');
        Route::get('/ajax/check/user/password/{password}', 'FunctionalController@ajaxCheckPassword')->name('ajax_check_user_password');
        Route::get('/ajax/get/assessor/{idw}', 'FunctionalController@ajaxGetAssessor')->name('ajax_get_assessor_info');
        Route::post('/ajax/resend/emails/', 'FunctionalController@ajaxResendMails')->name('ajax_post_resend_mails');

    });

    Route::get('/idle/{url?}', function () {
        Session::put('locked', true);
        return redirect()->route('lockscreen');
    })->name('idle');

    Route::get('/lockscreen', 'UserController@getLockScreen')->name('lockscreen');
    Route::post('/lockscreen/unlock', 'UserController@postUnlockScreen')->name('unlock');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::get('cronjobs', 'FunctionalController@CronJobs')->name('cronjob');

Auth::routes();
