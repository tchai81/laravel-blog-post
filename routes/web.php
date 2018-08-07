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

// User modules - Laravel
Auth::routes();

// Applicable only to registered Owner & User
Route::middleware('auth')->group(function () {
    Route::get('/home', 'BlogPostController@index')->name('home');
    Route::resource('blog-post', 'BlogPostController');

    Route::get('blog-post/{blog_post}/edit', 'BlogPostController@edit')->name('blog-post.edit');

});

// Public - blog listing page
Route::get('/', 'BlogPostController@publicIndex');
// Public - Individual Blog Post Page
Route::get('blog-post/{blog_post}', 'BlogPostController@show')->name('blog-post.show');
