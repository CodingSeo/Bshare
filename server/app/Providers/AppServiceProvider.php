<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected function bootHiworksSocialite(){
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend('hiworks', function ($app) use ($socialite) {
                $config = $app['config']['services.hiworks'];
                return $socialite->buildProvider(HiworksProvider::class, $config);
            }
        );
    }
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootHiworksSocialite();
    }


}
