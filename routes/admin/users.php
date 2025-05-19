<?php

use Illuminate\Support\Facades\Route;


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
