<?php

namespace App\Providers\Bshare;

use App\Http\Requests\APIRequest;
use Illuminate\Support\ServiceProvider;

class RequestProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }



    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $container = app();
        $container->resolving(APIRequest::class, function ($request, $app) {
            $request->merge($request->route()->parameters());
        });
    }
}
