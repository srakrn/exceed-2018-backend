<?php

use Illuminate\Http\Request;
use App\Logger;

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

Route::get('{key}/view', 'LogController@latestValue');
Route::get('{key}/set', 'LogController@set');
Route::post('{key}/set', 'LogController@set');
Route::get('{key}/history', 'LogController@query');

Route::get('old/view/{key_1}/{key_2}', 'TwoKeyLogController@query');
Route::get('old/view/{key_1}/{key_2}/latest', 'TwoKeyLogController@latest');
Route::get('old/view/{key_1}/{key_2}/latest/value', 'TwoKeyLogController@latestValue');
Route::get('old/set/{key_1}/{key_2}/{value}', 'TwoKeyLogController@set');
Route::post('old/set/{key_1}/{key_2}/{value}', 'TwoKeyLogController@set');
Route::get('old/keys/{key_1}/', 'TwoKeyLogController@keys');