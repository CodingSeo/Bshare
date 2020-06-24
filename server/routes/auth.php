<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [
    'as' => 'register',
    'uses' => 'JWTAuthController@register',
]);

Route::post('login', [
    'as' => 'login',
    'uses' => 'JWTAuthController@login'
]);

//Hiworks
Route::get('login/hiworks', [
    'as' => 'login.hiworks',
    'uses' => 'SocialiteController@redirectToProvider'
]);

Route::get('hiworks/callback', [
    'as' => 'hiworks.callback',
    'uses' => 'SocialiteController@handleProviderCallback'
]);

//+ should it be the

Route::get('user', [
    'as' => 'user',
    'uses' => 'JWTAuthController@user'
])->middleware('jwt');

Route::get('refresh', [
    'as' => 'refresh',
    'uses' => 'JWTAuthController@refresh'
])->middleware('jwt');

Route::get('logout', [
    'as' => 'logout',
    'uses' => 'JWTAuthController@logout'
])->middleware('jwt');
