<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', 'App\Http\Controllers\AdminController@loginAdmin');
Route::post('/admin', 'App\Http\Controllers\AdminController@postLoginAdmin');

Route::get('/home', function () {
    return view('home');
});


// Route: admin
Route::prefix('admin')->group(function () {
    // Route: Categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\CategoryController@index',
            'middleware' => 'can:category_list'
        ]);
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\CategoryController@create',
            'middleware' => 'can:category_add'
        ]);
        Route::post('/store', [
            'as' => 'categories.store',
            'uses' => 'App\Http\Controllers\CategoryController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit',
            'middleware' => 'can:category_edit'

        ]);
        Route::post('/update/{id}', [ // Changed from '/edit/{id}' to '/update/{id}'
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\CategoryController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\CategoryController@delete',
            'middleware' => 'can:category_delete'
        ]);
    });


    // Route: Menus
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'App\Http\Controllers\MenuController@index',
            'middleware' => 'can:menu_list'
        ]);
        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'App\Http\Controllers\MenuController@create'
        ]);

        Route::post('/store', [
            'as' => 'menus.store',
            'uses' => 'App\Http\Controllers\MenuController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'App\Http\Controllers\MenuController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'App\Http\Controllers\MenuController@delete'
        ]);
    });

    // Route: Product
    Route::prefix('products')->group(function () {
        Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });
        Route::get('/', [
            'as' => 'products.index',
            'uses' => 'App\Http\Controllers\AdminProductController@index',
            'middleware' => 'can:product_list'

        ]);

        // route: create
        Route::get('/create', [
            'as' => 'products.create',
            'uses' => 'App\Http\Controllers\AdminProductController@create',
            'middleware' => 'can:product_add'
        ]);

        Route::post('/store', [
            'as' => 'products.store',
            'uses' => 'App\Http\Controllers\AdminProductController@store',
        ]);

        // route: edit
        Route::get('/edit/{id}', [
            'as' => 'products.edit',
            'uses' => 'App\Http\Controllers\AdminProductController@edit',
            'middleware' => 'can:product_edit,id'

        ]);
        Route::post('/update/{id}', [
            'as' => 'products.update',
            'uses' => 'App\Http\Controllers\AdminProductController@update'
        ]);

        // route: delete
        Route::get('/delete/{id}', [
            'as' => 'products.delete',
            'uses' => 'App\Http\Controllers\AdminProductController@delete',
            'middleware' => 'can:product_delete'
        ]);
    });


    // Route: slider
    Route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as' => 'sliders.index',
            'uses' => 'App\Http\Controllers\SliderAdminController@index',
            'middleware' => 'can:slider_list'
        ]);

        // route: display page create
        Route::get('/create', [
            'as' => 'sliders.create',
            'uses' => 'App\Http\Controllers\SliderAdminController@create',
            'middleware' => 'can:slider_add'
        ]);
        // route: create
        Route::post('/store', [
            'as' => 'sliders.store',
            'uses' => 'App\Http\Controllers\SliderAdminController@store'
        ]);

        // route: display edit
        Route::get('/edit/{id}', [
            'as' => 'sliders.edit',
            'uses' => 'App\Http\Controllers\SliderAdminController@edit',
            'middleware' => 'can:slider_edit'
        ]);

        // route: update slider
        Route::post('/update/{id}', [
            'as' => 'sliders.update',
            'uses' => 'App\Http\Controllers\SliderAdminController@update'
        ]);

        // route: xóa slider
        Route::get('/delete/{id}', [
            'as' => 'sliders.delete',
            'uses' => 'App\Http\Controllers\SliderAdminController@delete',
            'middleware' => 'can:slider_delete'
        ]);
    });

    // Route: setting
    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'settings.index',
            'uses' => 'App\Http\Controllers\AdminSettingController@index',
            'middleware' => 'can:setting_list'
        ]);
        // route: tạo setting
        Route::get('/create', [
            'as' => 'settings.create',
            'uses' => 'App\Http\Controllers\AdminSettingController@create',
            'middleware' => 'can:setting_add'
        ]);

        Route::post('/store', [
            'as' => 'settings.store',
            'uses' => 'App\Http\Controllers\AdminSettingController@store',

        ]);
        // route display edit setting
        Route::get('/edit/{id}', [
            'as' => 'settings.edit',
            'uses' => 'App\Http\Controllers\AdminSettingController@edit',
            'middleware' => 'can:setting_edit'
        ]);
        // route: update setting
        Route::post('/update/{id}', [
            'as' => 'settings.update',
            'uses' => 'App\Http\Controllers\AdminSettingController@update'
        ]);
        // route: xóa setting
        Route::get('/delete/{id}', [
            'as' => 'settings.delete',
            'uses' => 'App\Http\Controllers\AdminSettingController@delete',
            'middleware' => 'can:setting_delete'
        ]);
    });

    // Route: users
    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'App\Http\Controllers\UserAdminController@index',
            'middleware' => 'can:setting_list'
        ]);
        // route: display page tạo user
        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'App\Http\Controllers\UserAdminController@create'
        ]);
        // route: tạo user
        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'App\Http\Controllers\UserAdminController@store'
        ]);
        // route: display page edit user
        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'App\Http\Controllers\UserAdminController@edit'
        ]);

        // route: update user
        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'App\Http\Controllers\UserAdminController@update'
        ]);

        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'uses' => 'App\Http\Controllers\UserAdminController@delete'
        ]);
    });

    // Route: role
    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'App\Http\Controllers\RoleAdminController@index',
            'middleware' => 'can:role_list'
        ]);

        // route : display add roles 
        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'App\Http\Controllers\RoleAdminController@create',
            'middleware' => 'can:role_add'

        ]);

        // route : post roles 
        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'App\Http\Controllers\RoleAdminController@store',
        ]);

        // route : display edit roles 
        Route::get('/edit/{id}', [
            'as' => 'roles.edit',
            'uses' => 'App\Http\Controllers\RoleAdminController@edit',
            'middleware' => 'can:role_edit'

        ]);

        // route : update roles 
        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'App\Http\Controllers\RoleAdminController@update'
        ]);

        // route : delete roles 
        Route::get('/delete/{id}', [
            'as' => 'roles.delete',
            'uses' => 'App\Http\Controllers\RoleAdminController@delete',
            'middleware' => 'can:role_delete'

        ]);
    });


    // route: permission
    Route::prefix('permissions')->group(function () {
        Route::get('/', [
            'as' => 'permissions.create',
            'uses' => 'App\Http\Controllers\PermissionAdminController@createPermission',
        ]);

        Route::post('/store', [
            'as' => 'permissions.store',
            'uses' => 'App\Http\Controllers\PermissionAdminController@store'
        ]);
    });
});
