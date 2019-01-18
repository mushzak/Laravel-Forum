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
Route::group(['middleware' => ['auth','checkRole:user']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/thread/create', 'ThreadsController@create')->name('thread.create');
    Route::post('/thread/store', 'ThreadsController@store')->name('thread.store');
    Route::get('/thread/destroy/{thread}', 'ThreadsController@destroy')->name('thread.destroy');
    Route::get('/thread/edit/{thread}', 'ThreadsController@edit')->name('thread.edit');
    Route::post('/thread/update', 'ThreadsController@update')->name('thread.update');
    Route::get('/thread/{thread}', 'ThreadsController@single')->name('thread.single');
    Route::post('/thread/reply', 'ThreadsController@reply')->name('thread.reply');
});
Route::get('/thread', 'ThreadsController@index')->name('thread');

Route::group(['middleware' => ['auth','checkRole:admin']], function () {
    Route::get('/thread/admin/destroy/{thread}', 'ThreadsController@adminDestroy')->name('thread.adminDestroy');
});



