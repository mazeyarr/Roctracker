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

    /* Colleges Page */
    Route::get('/dashboard/college', 'HomeController@getColleges')->name('colleges');

    Route::get('/dashboard/college/view/{id}', 'HomeController@getCollegeTimeline')->name('view_colleges');
    Route::get('/dashboard/college/change/{id}', 'HomeController@getChangeColleges')->name('change_colleges');
    Route::post('/dashboard/college/change/{id}/check', 'CollegeController@postChangeCollege')->name('save_change_colleges');
    Route::get('/dashboard/college/change/{id}/check/selection/{collegename?}/{collegelocation?}', 'CollegeController@getChangeAssessorsSelection')->name('change_college_assessors');

    Route::get('/dashboard/college/save/assessor/{id}/{collegeid}', 'FunctionalController@ajaxSaveAssessorToCollege')->name('ajax_save_college_by_selection');
    Route::get('/dashboard/college/save/{id}/{name}/{location}/{team}', 'FunctionalController@ajaxSaveCollege')->name('ajax_save_college');


    /* Teamleaders Page */
    Route::get('/dashboard/teamleaders', 'HomeController@getTeamleaders')->name('teamleaders');

    Route::get('/dashboard/teamleader/view/{id}', 'HomeController@getTeamleaderTimeline')->name('view_teamleaders');
    Route::get('/dashboard/teamleader/change/{id}', 'HomeController@getChangeTeamleader')->name('change_teamleaders');
    Route::post('/dashboard/teamleader/change/{id}/check', 'TeamleaderController@postChangeTeamleader')->name('save_change_teamleaders');

    Route::get('/dashboard/teamleader/save/{id}/{name}/{team}', 'FunctionalController@ajaxSaveTeamleader')->name('ajax_save_teamleader');


    /* Assessors Page */
    Route::get('/dashboard/assessors', 'HomeController@getAssessors')->name('assessors');

    Route::get('/dashboard/assessor/profile/{id}', 'HomeController@getAssessorProfile')->name('view_assessor_profiel');
    Route::get('/dashboard/assessor/view/{id}', 'HomeController@getAssessorTimeline')->name('view_assessor');
    Route::get('/dashboard/assessor/change/{id}', 'HomeController@getChangeAssessor')->name('change_assessor');
    Route::post('/dashboard/assessor/change/{id}/check', 'AssessorController@postChangeAssessor')->name('save_change_assessor');
    Route::get('/dashboard/assessor/add/', 'HomeController@getAddAssessor')->name('add_assessor');
    Route::get('/dashboard/assessor/add/manual', 'HomeController@getAddAssessorManual')->name('add_assessor_manual');
    Route::post('/dashboard/assessor/add/manual/save/{count?}', 'AssessorController@postAddAssessorManual')->name('add_assessor_manual_save');
    Route::get('/dashboard/assessor/add/automatic', 'HomeController@getAddAssessorAutomatic')->name('add_assessor_automatic');

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
