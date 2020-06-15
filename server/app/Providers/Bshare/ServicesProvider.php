<?php

namespace App\Providers\Bshare;

use App\Http\Controllers\PostsController;
use App\Http\Requests\PostsRequest;
use App\Http\Requests\Request;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $container = app();



    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
