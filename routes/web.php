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

Route::get('/', 'ItemController@index')->name('index');
Route::post('/items/import', 'ItemController@import')->name('items.import');
Route::get('/items/truncate', 'ItemController@truncate')->name('items.truncate');
