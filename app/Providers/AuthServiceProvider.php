<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
        Gate::define('list_category', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list_category'));
        });

        Gate::define('list_menu', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.list_menu'));
        });
    }
}
