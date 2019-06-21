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

Route::get('/','PagesController@index');
Route::get('/register','PagesController@register');
Route::get('/search','PagesController@search');
Route::get('/fees','PagesController@fees');
Route::get('/payments','FeesController@payments');
Route::post('/register','StudentsController@register');
Route::post('/fees','FeesController@payFees');
Route::post('/search','StudentsController@find');