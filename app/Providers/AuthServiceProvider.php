<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport; 

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

        //Expose passport routing endpoints
        Passport::routes(); 
        Passport::tokensExpireIn(now()->addDays(env('LARAVEL_PASSPORT_TOKEN_EXPIRY_DAYS')));
        Passport::refreshTokensExpireIn(now()->addDays(env('LARAVEL_PASSPORT_REFRESH_TOKEN_EXPIRY_DAYS')));
    }
}
