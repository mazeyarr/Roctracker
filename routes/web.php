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
    Route::get('/dashboard', 'HomeController@getDashboard')->name('dashboard');

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

    /* Administrator page*/
    Route::get('/users', 'HomeController@getUsers')->name('users');
    Route::get('/users/new', 'HomeController@getNewUsers')->name('add_users');
    Route::post('/users/new', 'UserController@postNewAdmin')->name('new_user');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Auth::routes();
