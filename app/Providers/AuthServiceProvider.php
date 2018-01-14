<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

        'App\Developer' => 'App\Policies\DeveloperPolicy',
        'App\Publisher' => 'App\Policies\PublisherPolicy',
        'App\Genre' => 'App\Policies\GenrePolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'App\Cart' => 'App\Policies\CartPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
