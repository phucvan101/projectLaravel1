<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


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

    Route::get('/search', [CategoryController::class, 'search'])->name('categories.search');
});
