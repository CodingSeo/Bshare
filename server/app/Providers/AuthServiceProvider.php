<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Auth\AuthUser;
use App\Auth\AuthUserProvider;
use App\Auth\Implement\EloquentAuthUserReository;
use App\Auth\Implement\GuestAuthUserRepository;
use App\Auth\Implement\HiworksAuthUserRepository;
use App\Auth\Manager\JWTAuthManager;
use App\Auth\Manager\JWTAuthManagerTymond;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
        $container = app();
        $jwtTymond = $container->make(JWTAuthManagerTymond::class);
        $container->singleton(JWTAuthManager::class, function($app) use($jwtTymond){
            return $jwtTymond;
        });
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $container = app();
        //requestVia should be implied
        switch (request()->header('AUTH_TYPE')) {
            case 'hiworks':
                $repository = new HiworksAuthUserRepository();
                break;
            case 'eloquent':
                $repository = $container->make(EloquentAuthUserReository::class);
                break;
            default:
                $repository = $container->make(EloquentAuthUserReository::class);
                break;
        }
        Auth::provider('auth', function ($app, array $config) use ($repository) {
            return new AuthUserProvider($repository);
        });
    }
}
