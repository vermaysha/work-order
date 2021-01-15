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

Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@login');

Route::middleware('auth')->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/request', 'OrderController@create')->name('request');
    Route::post('/request', 'OrderController@store');

    Route::get('/order', 'OrderController@all')->name('order');
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

    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::post('/profile', 'UserController@updateProfile');
    Route::post('/profile/password', 'UserController@updateProfilePassword')->name('profile.password');

    Route::get('/user', 'UserController@all')->name('user');
    Route::name('user.')->prefix('user')->group(function(){
        Route::get('detail/{id}', 'UserController@show')->name('detail');
        Route::get('delete/{id}', 'UserController@destroy')->name('delete');

        Route::get('create', 'UserController@create')->name('create');
        Route::post('create', 'UserController@store');
        Route::get('edit/{id}', 'UserController@edit')->name('edit');
        Route::post('edit/{id}', 'UserController@update');
    });
});
