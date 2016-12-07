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
    Route::get('/dashboard/college/change/{id}', 'HomeController@getChangeColleges')->name('change_colleges');
    Route::get('/dashboard/college/save/{id}/{name}/{location}', 'FunctionalController@ajaxSaveCollege')->name('ajax_save_college');

    /* Teamleaders Page */
    Route::get('/dashboard/teamleaders', 'HomeController@getTeamleaders')->name('teamleaders');

    /* Assessors Page */
    Route::get('/dashboard/assessors', 'HomeController@getAssessors')->name('assessors');

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
