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
Route::get('category', [
    'as' => 'category',
    'uses' => 'CategoriesController@show'
]);
Route::get('category/QnA', [
    'as' => 'category.qna',
    'uses' => 'CategoriesController@getQnAPosts'
]);

//post router
Route::get('posts/mostViews/{amount}', [
    'as' => 'posts.mostviews',
    'uses' => 'PostsController@showMostViews'
]);

Route::get('posts/mostRecents/{amount}', [
    'as' => 'posts.mostrecents',
    'uses' => 'PostsController@showMostRecents'
]);

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
    'as' => 'posts.comments.update',
    'uses' => 'CommentsController@update'
])->middleware('jwt');

Route::delete('comments/{comment_id}', [
    'as' => 'posts.comments.delete',
    'uses' => 'CommentsController@destroy'
])->middleware('jwt');


//today's mission to implement this part
Route::post('file', [
    'as' => 'posts.file.store',
    'uses' => 'FilesController@store'
])->middleware('jwt');

Route::delete('file/{file_id}', [
    'as' => 'posts.file.delete',
    'uses' => 'FilesController@destroy'
])->middleware('jwt');
