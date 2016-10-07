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

Auth::loginUsingId(1);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/monitor', 'MonitorController@index');
    Route::get('/calendar/sb', 'FullCalendarController@getServiceBureauCalendar');
    Route::get('/calendar/dtc', 'FullCalendarController@getDiversifiedCalendar');
    Route::post('/pusher/authenticate', 'PusherController@authenticate');
    Route::get('/logout', 'Auth\LoginController@logout');

    Route::get('/api/users', 'UserController@index');
    Route::get('/api/users/{id}/roles', 'UserController@roles');
    
    Route::any('/{all}', function () {
        return view('dashboard');
    })
    ->where(['all' => '.*']);
});

Route::auth();
