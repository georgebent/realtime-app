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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/push', 'HomeController@push')->name('push-user');

Route::get('/api/user', 'Api\UserApiController@getUser')->name('api-get-user');
Route::get('/api/users', 'Api\UserApiController@getUsers')->name('api-get-users');
