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
            'uses' => 'App\Http\Controllers\CategoryController@index'
        ]);
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\CategoryController@create'
        ]);
        Route::post('/store', [
            'as' => 'categories.store',
            'uses' => 'App\Http\Controllers\CategoryController@store'
        ]);
        Route::get('/store/{id}', [
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit'
        ]);
        Route::post('/update/{id}', [ // Changed from '/edit/{id}' to '/update/{id}'
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\CategoryController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\CategoryController@delete'
        ]);
    });


    // Route: Menus
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'App\Http\Controllers\MenuController@index'
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
            'uses' => 'App\Http\Controllers\AdminProductController@index'
        ]);

        // route: create
        Route::get('/create', [
            'as' => 'products.create',
            'uses' => 'App\Http\Controllers\AdminProductController@create'
        ]);

        Route::post('/store', [
            'as' => 'products.store',
            'uses' => 'App\Http\Controllers\AdminProductController@store'
        ]);

        // route: edit
        Route::get('/edit/{id}', [
            'as' => 'products.edit',
            'uses' => 'App\Http\Controllers\AdminProductController@edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'products.update',
            'uses' => 'App\Http\Controllers\AdminProductController@update'
        ]);

        // route: delete
        Route::get('/delete/{id}', [
            'as' => 'products.delete',
            'uses' => 'App\Http\Controllers\AdminProductController@delete'
        ]);
    });

    // Route: Slider
    // Route::prefix('sliders')->group(function () {
    //     Route::get('/', [
    //         'as' => 'sliders.index',
    //         'users' => 'App\Http\Controllers\SliderAdminController@index'
    //     ]);
    // });

    // Route: slider
    Route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as' => 'sliders.index',
            'uses' => 'App\Http\Controllers\SliderAdminController@index'
        ]);

        // route: display page create
        Route::get('/create', [
            'as' => 'sliders.create',
            'uses' => 'App\Http\Controllers\SliderAdminController@create'
        ]);
        // route: create
        Route::post('/store', [
            'as' => 'sliders.store',
            'uses' => 'App\Http\Controllers\SliderAdminController@store'
        ]);

        // route: display edit
        Route::get('/edit/{id}', [
            'as' => 'sliders.edit',
            'uses' => 'App\Http\Controllers\SliderAdminController@edit'
        ]);

        // route: update slider
        Route::post('/update/{id}', [
            'as' => 'sliders.update',
            'uses' => 'App\Http\Controllers\SliderAdminController@update'
        ]);

        // route: xóa slider
        Route::get('/delete/{id}', [
            'as' => 'sliders.delete',
            'uses' => 'App\Http\Controllers\SliderAdminController@delete'
        ]);
    });

    // Route: setting
    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'settings.index',
            'uses' => 'App\Http\Controllers\AdminSettingController@index'
        ]);
        // route: tạo setting
        Route::get('/create', [
            'as' => 'settings.create',
            'uses' => 'App\Http\Controllers\AdminSettingController@create'
        ]);

        Route::post('/store', [
            'as' => 'settings.store',
            'uses' => 'App\Http\Controllers\AdminSettingController@store'
        ]);
        // route display edit setting
        Route::get('/edit/{id}', [
            'as' => 'settings.edit',
            'uses' => 'App\Http\Controllers\AdminSettingController@edit'
        ]);
        // route: update setting
        Route::post('/update/{id}', [
            'as' => 'settings.update',
            'uses' => 'App\Http\Controllers\AdminSettingController@update'
        ]);
        // route: xóa setting
        Route::get('/delete/{id}', [
            'as' => 'settings.delete',
            'uses' => 'App\Http\Controllers\AdminSettingController@delete'
        ]);
    });

    // Route: users
    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'App\Http\Controllers\UserAdminController@index'
        ]);

        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'App\Http\Controllers\UserAdminController@create'
        ]);
    });
});
