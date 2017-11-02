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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cms', 'CmsController@index')->name('cms');
Route::post('/cms/add','CmsController@add')->name('cms.add');
Route::post('/cms/edit','CmsController@edit')->name('cms.edit');
Route::post('/cms/destroy','CmsController@destroy')->name('cms.destroy');

Route::resource('link','LinkController');

Route::get('/show/{id}','LinkController@show');

Route::get('/stats/{id}','CmsController@stats');

Route::post('/edit/change','LinkController@edit')->name('link.edit');