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
    Route::get('/dashboard', 'HomeController@getDashboard')->name('dashboard');

    Route::get('/users', 'HomeController@getUsers')->name('users');
    Route::post('/users', 'UserController@postNewAdmin')->name('new_user');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Auth::routes();
