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

Route::get('post/{slug}','PostController@details')->name('post.details');
Route::get('all/post/','PostController@all')->name('post.all');
Route::get('category/posts/{slug}','PostController@categoryPost')->name('post.category');
Route::get('tag/posts/{slug}','PostController@tagPost')->name('post.tag');

Route::post('posts/search','PostController@search')->name('search');

Route::post('/subscriber', 'SubscriberController@store')->name('subscriber.store');

Route::get('profile/{name}','ProfileController@profile')->name('profile');





Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware'=>['auth']], function (){

    Route::post('favourite/post/{id}','FavouriteController@favourite')->name('post.favourite');
    Route::get('favourite/posts/','FavouriteController@favouritePosts')->name('favourite.posts');

    Route::post('post/comment/{id}','CommentController@store')->name('comment.store');


});


Route::group([ 'as'=>'admin.', 'prefix'=> 'admin', 'namespace'=>'admin','middleware'=>['auth','admin']], function(){

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/tag', 'TagController');
    Route::resource('/category', 'CategoryController');
    Route::resource('/post', 'PostController');

    Route::get('/pending/post', 'PostController@pending')->name('post.pending');
    Route::put('/post/approve/{id}','PostController@approval')->name('post.approve');



    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::post('/settings/update/profile', 'SettingsController@updateProfile')->name('profile.update');
    Route::post('/settings/change/password', 'SettingsController@changePassword')->name('profile.password');

    Route::get('comments/', 'CommentController@index')->name('comment.index');
    Route::delete('comments/destroy/{id}', 'CommentController@destroy')->name('comment.destroy');

    Route::get('authors/', 'UserController@index')->name('user.index');
    Route::delete('author/destroy/{id}', 'UserController@destroy')->name('user.destroy');




});

Route::group([ 'as'=>'author.', 'prefix'=> 'author', 'namespace'=>'author','middleware'=>['auth','author']], function(){

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/post', 'PostController');


    Route::get('comments/', 'CommentController@index')->name('comment.index');
    Route::delete('comments/destroy/{id}', 'CommentController@destroy')->name('comment.destroy');


    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::post('/settings/update/profile', 'SettingsController@updateProfile')->name('profile.update');
    Route::post('/settings/change/password', 'SettingsController@changePassword')->name('profile.password');


});


View::composer('layouts.frontend.footer',function ($view){
    $categories = \App\Category::all();
    $view->with('categories',$categories);
});
