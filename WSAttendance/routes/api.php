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

Route::get('/api/attendancelog', 'AttendanceLogController@GetLog');

Route::post('/api/attendancelog', 'ApiController@CreateLog');

Route::delete('/api/attendancelog', 'ApiController@DeleteLog');
