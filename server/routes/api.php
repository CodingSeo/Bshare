<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [
    'as' => 'index',
    'uses' => 'HomeController@index',
]);

//category routers
Route::get('category/{category_id}/posts', [
    'as' => 'category.index',
    'uses' => 'CategoriesController@index'
]);

//post routers
Route::get('posts/{post_id}', [
    'as' => 'posts.show',
    'uses' => 'PostsController@show'
]);

Route::post('posts', [
    'as' => 'posts.store',
    'uses' => 'PostsController@store'
])->middleware('jwt');

Route::put('posts/{post_id}', [
    'as' => 'posts.update',
    'uses' => 'PostsController@update'
])->middleware('jwt');

Route::delete('posts/{post_id}', [
    'as' => 'posts.delete',
    'uses' => 'PostsController@destroy'
])->middleware('jwt');

//comments routers
Route::post('comments', [
    'as' => 'posts.comments.store',
    'uses' => 'CommentsController@store'
])->middleware('jwt');
Route::put('comments/{comment_id}', [
    'as' => 'comments.update',
    'uses' => 'CommentsController@update'
])->middleware('jwt');
Route::delete('comments/{comment_id}', [
    'as' => 'comments.delete',
    'uses' => 'CommentsController@destroy'
])->middleware('jwt');
