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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false,
]);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('jobs', 'JobController')->except(['destroy']);
    Route::group(['prefix' => 'jobs'], function () {
        Route::post('to-open/{job}', 'JobController@to_open')->name('jobs.to_open');
        Route::post('to-close/{job}', 'JobController@to_close')->name('jobs.to_close');
    });

    Route::group(['prefix' => 'applications'], function () {
        Route::post('to-accept/{application}', 'ApplicationController@to_accept')->name('applications.to_accept');
        Route::post('to-reject/{application}', 'ApplicationController@to_reject')->name('applications.to_reject');
    });
});

Route::get('/', function () {
    return redirect('spa/');
});
Route::view('spa/{any?}', 'spa')->where('any', '(.*)');