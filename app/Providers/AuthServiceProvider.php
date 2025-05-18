<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Services\PermissionGateAndPolicyAccess;

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
        $permissionGateAndPolicy = new PermissionGateAndPolicyAccess();
        $permissionGateAndPolicy->setGateAndPolicy();


        // Gate::define('menu_list', function ($user) {
        //     return $user->checkPermissionAccess(config('permissions.access.menu_list'));
        // });

        // Gate::define('product_list', function ($user) {
        //     return $user->checkPermissionAccess('product_list');
        // });

        // Gate::define('product_edit', function ($user, $id) {
        //     $product = Product::find($id);
        //     if ($user->checkPermissionAccess('product_edit') && $user->id === $product->user_id) {
        //         return true;
        //     }
        //     // return $user->checkPermissionAccess('product_edit');
        //     return false;
        // });
    }
}
