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
        Gate::define('category_list', 'App\Policies\CategoryPolicy@view');
        $this->registerPolicies();
        Gate::define('category_add', 'App\Policies\CategoryPolicy@create');
        $this->registerPolicies();
        Gate::define('category_edit', 'App\Policies\CategoryPolicy@update');
        $this->registerPolicies();
        Gate::define('category_delete', 'App\Policies\CategoryPolicy@delete');



        Gate::define('menu_list', function ($user) {
            return $user->checkPermissionAccess(config('permissions.access.menu_list'));
        });
    }
}
