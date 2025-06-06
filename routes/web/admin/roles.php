<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleAdminController;


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

    Route::get('/search', [RoleAdminController::class, 'search'])->name('roles.search');
});
