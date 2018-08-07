<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// CRUD api endpoints for comment - for ajax usage
Route::resource('comment', 'CommentController');
Route::get('blog-post/{blog_post}/comments', 'CommentController@show')->name('blog-post.comment.show');
