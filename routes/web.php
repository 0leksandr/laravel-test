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

use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('welcome');
});

//Route::get('login', 'Auth\LoginController@showLoginForm');
//Route::post('login', 'Auth\LoginController@login2');
Route::get('login', 'Auth2\LoginController@get');
Route::post('login', 'Auth2\LoginController@post');
Route::get('logout', 'Auth2\LoginController@logout');

Route::get('register', 'Auth2\RegisterController@get');
Route::post('register', 'Auth2\RegisterController@post');

Route::get('feedback', 'FeedbackController@index');
Route::post('feedback', 'FeedbackController@store');
