<?php

use Illuminate\Support\Facades\Route;


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
