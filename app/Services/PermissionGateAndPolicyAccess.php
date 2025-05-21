<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicyAccess
{
    public function setGateAndPolicy()
    {
        $this->defineGateCategory();
        $this->defineGateMenu();
        $this->defineGateProduct();
        $this->defineGateSlider();
        $this->defineGateSetting();
        $this->defineGateRole();
        $this->defineGateUser();
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

    // product
    public function defineGateProduct()
    {
        Gate::define('product_list', 'App\Policies\ProductPolicy@view');
        Gate::define('product_add', 'App\Policies\ProductPolicy@create');
        Gate::define('product_edit', 'App\Policies\ProductPolicy@update');
        Gate::define('product_delete', 'App\Policies\ProductPolicy@delete');
    }

    // slider
    public function defineGateSlider()
    {
        Gate::define('slider_list', 'App\Policies\SliderPolicy@view');
        Gate::define('slider_add', 'App\Policies\SliderPolicy@create');
        Gate::define('slider_edit', 'App\Policies\SliderPolicy@update');
        Gate::define('slider_delete', 'App\Policies\SliderPolicy@delete');
    }


    // setting
    public function defineGateSetting()
    {
        Gate::define('setting_list', 'App\Policies\SettingPolicy@view');
        Gate::define('setting_add', 'App\Policies\SettingPolicy@create');
        Gate::define('setting_edit', 'App\Policies\SettingPolicy@update');
        Gate::define('setting_delete', 'App\Policies\SettingPolicy@delete');
    }

    // role
    public function defineGateRole()
    {
        Gate::define('role_list', 'App\Policies\RolePolicy@view');
        Gate::define('role_add', 'App\Policies\RolePolicy@create');
        Gate::define('role_edit', 'App\Policies\RolePolicy@update');
        Gate::define('role_delete', 'App\Policies\RolePolicy@delete');
    }

    // user
    public function defineGateUser()
    {
        Gate::define('user_list', 'App\Policies\UserPolicy@view');
        Gate::define('user_add', 'App\Policies\UserPolicy@create');
        Gate::define('user_edit', 'App\Policies\UserPolicy@update');
        Gate::define('user_delete', 'App\Policies\UserPolicy@delete');
    }
}
