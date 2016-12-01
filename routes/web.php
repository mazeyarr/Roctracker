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

    Route::get('/dashboard/teamleaders', 'HomeController@getTeamleaders')->name('teamleaders');

    Route::get('/dashboard/college', 'HomeController@getColleges')->name('college');
    Route::get('/dashboard/college/new', 'HomeController@getNewColleges')->name('add_college');
    Route::post('/dashboard/college/new', 'DashboardController@postNewColleges')->name('new_college');
    Route::any('/dashboard/college/change/{id}/{name}/{location}/{teamleader}', 'DashboardController@ajaxChangeCollege')->name('change_college');

    Route::get('/users', 'HomeController@getUsers')->name('users');
    Route::get('/users/new', 'HomeController@getNewUsers')->name('add_users');
    Route::post('/users/new', 'UserController@postNewAdmin')->name('new_user');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Auth::routes();
