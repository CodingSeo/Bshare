<?php

namespace App\Providers\Bshare;

use Illuminate\Support\ServiceProvider;
use App\Auth\Manager\JWTAuthManager;
use App\Auth\Manager\JWTAuthManagerTymond;

class JWTManagerProvider extends ServiceProvider
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
        //
    }
}
