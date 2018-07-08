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

Route::get('/view/{key_1}/{key_2}', 'LogController@query');
Route::get('/view/{key_1}/{key_2}/latest', 'LogController@latest');
Route::get('/view/{key_1}/{key_2}/latest/value', 'LogController@latestValue');
Route::get('/set/{key_1}/{key_2}/{value}', 'LogController@set');
Route::post('/set/{key_1}/{key_2}/{value}', 'LogController@set');
Route::get('/keys/{key_1}/', 'LogController@keys');