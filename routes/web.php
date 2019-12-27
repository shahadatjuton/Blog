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

Route::get('/','HomeController@index')->name('home');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::group([ 'as'=>'admin.', 'prefix'=> 'admin', 'namespace'=>'admin','middleware'=>['auth','admin']], function(){

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/tag', 'TagController');
    Route::resource('/category', 'CategoryController');
    Route::resource('/post', 'PostController');
    Route::post('/subscriber', 'SubscriberController@store')->name('subscriber.store');
    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::post('/settings/update/profile', 'SettingsController@updateProfile')->name('profile.update');
    Route::post('/settings/change/password', 'SettingsController@changePassword')->name('profile.password');






});

Route::group([ 'as'=>'author.', 'prefix'=> 'author', 'namespace'=>'author','middleware'=>['auth','author']], function(){

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/post', 'PostController');

});
