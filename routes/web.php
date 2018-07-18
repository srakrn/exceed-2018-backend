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

// This is an automated routes for the Laravel's `auth` bootstrap
// This line should be commented, as the register route should not be visible
// by any kind of users.
// Auth::routes();

$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Homepage routes
Route::get('/', function () {
    return view('api_docs');
});

// Settings routes
Route::get('/preferences', 'PreferencesController@preferences');
Route::post('/preferences/save', 'PreferencesController@save');
