<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// TODO
Route::get('jobs', 'Api\\JobController@get_open');
Route::get('jobs/{job}', 'Api\\JobController@get_job');
Route::post('jobs/{job}/send-application', 'Api\\JobController@send_application');
