<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("admin",function($user){
            return $user->profil == 'admin';
        });

        Gate::define("gestionnaire",function($user){
            return $user->profil == 'gestionnaire';
        });

        Gate::define("technicien",function($user){
            return $user->profil == 'technicien';
        });

        Gate::define("client",function($user){
            return $user->profil == 'client';
        });
    }
}
