<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'jwt.',], function () {
    Route::post('register', [
        'as' => 'register',
        'uses' => 'JWTAuthController@register',
    ]);

    Route::post('login', [
        'as' => 'login',
        'uses' => 'JWTAuthController@login'
    ]);

    //middleware checking if token is avaliable
    //+ maybe with the client???????
    //+ then how can we check the user id and posts id?
    //+ should it be the
    Route::group(['middleware' => 'jwt.verify'], function () {
        Route::get('user', [
            'as' => 'user',
            'uses' => 'JWTAuthController@user'
        ]);
        Route::get('refresh', [
            'as' => 'refresh',
            'uses' => 'JWTAuthController@refresh'
        ]);
        Route::get('logout', [
            'as' => 'logout',
            'uses' => 'JWTAuthController@logout'
        ]);
    });

    // // //socialite
    // Route::get('login/hiworks', [
    //     'as' => 'login.hiworks',
    //     'uses' => 'SocialiteController@redirectToProvider'
    // ]);

    // Route::get('hiworks/callback', [
    //     'as' => 'hiworks.callback',
    //     'uses' => 'SocialiteController@handleProviderCallback'
    // ]);

    // //허가가 없는 상태
    // Route::get('unauthorized', function () {
    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'Unauthorized'
    //     ], 401);
    // })->name('unauthorized');
});
