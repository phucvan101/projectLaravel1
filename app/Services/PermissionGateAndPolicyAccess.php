<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess
{
    public function setGateAndPolicy()
    {
        $this->defineGateCategory();
        $this->defineGateMenu();
    }

    // category
    public function defineGateCategory()
    {
        Gate::define('category_list', 'App\Policies\CategoryPolicy@view');
        Gate::define('category_add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category_edit', 'App\Policies\CategoryPolicy@update');
        Gate::define('category_delete', 'App\Policies\CategoryPolicy@delete');
    }

    // menu
    public function defineGateMenu()
    {
        Gate::define('menu_list', 'App\Policies\MenuPolicy@view');
        Gate::define('menu_add', 'App\Policies\MenuPolicy@create');
        Gate::define('menu_edit', 'App\Policies\MenuPolicy@update');
        Gate::define('menu_delete', 'App\Policies\MenuPolicy@delete');
    }
}
