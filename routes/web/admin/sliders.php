<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderAdminController;

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
    // route: search
    Route::get('/search', [SliderAdminController::class, 'search'])->name('sliders.search');
});
