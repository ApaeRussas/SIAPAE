<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use app\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Defining a gate
        Gate::define('admin-view', function(User $user) {
            return $user->access_level === "admin";
        });

        Gate::define('coordinator-view', function(User $user) {
            return $user->position === "Cordenador(a)";
        });
    }
}