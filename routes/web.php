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
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::group(['prefix' => 'dashboard'], function () {

        /* Colleges Page */
        Route::get('college', 'HomeController@getColleges')->name('colleges');
        Route::group(['prefix' => 'college'], function () {
            Route::get('view/{id}', 'HomeController@getCollegeTimeline')->name('view_colleges');
            Route::get('change/{id}', 'HomeController@getChangeColleges')->name('change_colleges');
            Route::post('change/{id}/check', 'CollegeController@postChangeCollege')->name('save_change_colleges');
            Route::get('change/{id}/check/selection/{collegename?}/{collegelocation?}', 'CollegeController@getChangeAssessorsSelection')->name('change_college_assessors');

            Route::get('save/assessor/{id}/{collegeid}', 'FunctionalController@ajaxSaveAssessorToCollege')->name('ajax_save_college_by_selection');
            Route::get('save/{id}/{name}/{location}/{team}', 'FunctionalController@ajaxSaveCollege')->name('ajax_save_college');
        });


        /* Teamleaders Page */
        Route::get('teamleaders', 'HomeController@getTeamleaders')->name('teamleaders');
        Route::group(['prefix' => 'teamleader'], function () {
            Route::get('view/{id}', 'HomeController@getTeamleaderTimeline')->name('view_teamleaders');
            Route::get('change/{id}', 'HomeController@getChangeTeamleader')->name('change_teamleaders');
            Route::post('change/{id}/check', 'TeamleaderController@postChangeTeamleader')->name('save_change_teamleaders');

            Route::get('save/{id}/{name}/{team}', 'FunctionalController@ajaxSaveTeamleader')->name('ajax_save_teamleader');
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

    /* Dashboard Page */
    Route::get('/dashboard/{year?}', 'HomeController@getDashboard')->name('dashboard');
    Route::get('/history/data/get', 'FunctionalController@ajaxGetHistoryData')->name('ajax_history_data_get');
    Route::get('/assessor/data/get', 'FunctionalController@ajaxGetAssessorData')->name('ajax_assessor_data_get');

    /* Administrator page*/
    Route::get('/users', 'HomeController@getUsers')->name('users');
    Route::get('/users/new', 'HomeController@getNewUsers')->name('add_users');
    Route::post('/users/new', 'UserController@postNewAdmin')->name('new_user');

    /* AJAX INDEPENDENT ROUTES */
    Route::get('/ajax/get/colleges/{option}', 'FunctionalController@ajaxGetColleges')->name('ajax_get_colleges');

});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Auth::routes();
