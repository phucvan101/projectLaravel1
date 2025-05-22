<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAdminController;

Route::prefix('users')->group(function () {
    Route::get('/', [
        'as' => 'users.index',
        'uses' => 'App\Http\Controllers\UserAdminController@index',
        'middleware' => 'can:user_list'
    ]);
    // route: display page tạo user
    Route::get('/create', [
        'as' => 'users.create',
        'uses' => 'App\Http\Controllers\UserAdminController@create',
        'middleware' => 'can:user_list'
    ]);
    // route: tạo user
    Route::post('/store', [
        'as' => 'users.store',
        'uses' => 'App\Http\Controllers\UserAdminController@store'
    ]);
    // route: display page edit user
    Route::get('/edit/{id}', [
        'as' => 'users.edit',
        'uses' => 'App\Http\Controllers\UserAdminController@edit',
        'middleware' => 'can:user_list'
    ]);

    // route: update user
    Route::post('/update/{id}', [
        'as' => 'users.update',
        'uses' => 'App\Http\Controllers\UserAdminController@update'
    ]);

    Route::get('/delete/{id}', [
        'as' => 'users.delete',
        'uses' => 'App\Http\Controllers\UserAdminController@delete',
        'middleware' => 'can:user_list'
    ]);

    Route::get('/search', [UserAdminController::class, 'search'])->name('users.search');
});
