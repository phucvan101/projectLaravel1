<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProductController;

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

    // route: search
    Route::get('/search', [AdminProductController::class, 'search'])->name('products.search');
});
