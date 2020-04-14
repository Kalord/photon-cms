<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    var_dump(Auth()->user());
});

Route::get('/login', 'SiteController@login')->middleware('guest');
Route::get('/registration', 'SiteController@registration')->middleware('guest');
Route::get('/logout', 'SessionController@logout')->middleware('auth');

Route::group(['prefix' => 'session'], function() {
    Route::post('start', 'SessionController@start')->middleware('guest');
});

Route::group(['prefix' => 'user'], function() {
    Route::post('create', 'UserController@create')->middleware('guest');
});

Route::group(['prefix' => 'admin/module'], function() {
    Route::get('', 'ModuleController@index')->middleware('auth');
});

Route::group(['prefix' => 'admin/post'], function() {
    Route::get('', 'PostController@index')->middleware('auth');
    Route::get('create', 'PostController@publish')->middleware('auth');
    Route::post('create', 'PostController@create')->middleware('auth');
});