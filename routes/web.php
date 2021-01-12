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
Route::get('/logout', 'Auth\LoginController@logout')->middleware('auth');

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function() {
    Route::get('/request', 'OrderController@create')->name('request');
    Route::post('/request', 'OrderController@store');

    Route::name('order.')->prefix('order')->group(function(){
        Route::get('in', 'OrderController@in')->name('in');
        Route::get('out', 'OrderController@out')->name('out');
        Route::get('detail/{woNumber}', 'OrderController@show')->name('detail');
        Route::get('edit-status/{woNumber}', 'OrderController@editStatus')->name('edit');
        Route::post('edit-status/{woNumber}', 'OrderController@updateStatus');
        Route::get('edit/{woNumber}', 'OrderController@edit')->name('edit');
        Route::post('edit/{woNumber}', 'OrderController@update');
        Route::get('delete/{woNumber}', 'OrderController@destroy')->name('delete');
    });
});
