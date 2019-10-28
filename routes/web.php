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

Route::get('/', 'FileController@index');

Route::post('/', 'FileController@submitFile');

Route::get('/github', 'FileController@indexGithub');

Route::post('/github', 'FileController@downloadGithub');

Route::post('/ajax_result', 'FileController@load_results');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');