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

Route::get('/home', 'FileController@index')->name('home');

Route::get('/', 'FileController@index');

Route::post('/', 'FileController@submitFile');

Route::get('/github', 'GithubFilesController@index');

Route::post('/github', 'GithubFilesController@downloadGithub');

Route::get('/yourfiles', 'FileController@indexYourFiles');

Route::get('/yourfiles/{id}', 'FileResultsController@showFileResults');