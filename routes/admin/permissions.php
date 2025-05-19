<?php

use Illuminate\Support\Facades\Route;


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
