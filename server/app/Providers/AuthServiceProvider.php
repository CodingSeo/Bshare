<?php

namespace App\Providers;

use App\Auth\AuthUserProvider;
use App\Auth\Implement\EloquentAuthUserReository;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $container = app();
        $repository = $container->make(EloquentAuthUserReository::class);
        Auth::provider('auth', function ($app, array $config) use ($repository) {
            return new AuthUserProvider($repository);
        });

    }
}
