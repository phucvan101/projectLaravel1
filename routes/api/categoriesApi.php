<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('categories', [App\Http\Controllers\Api\CategoryController::class, 'index'])
        ->middleware('can:category_list');
    Route::get('categories/{category}', [App\Http\Controllers\Api\CategoryController::class, 'show']);
    Route::post('categories', [App\Http\Controllers\Api\CategoryController::class, 'store'])
        ->middleware('can:category_add');
    Route::put('categories/{category}', [App\Http\Controllers\Api\CategoryController::class, 'update']);
    Route::delete('categories/{category}', [App\Http\Controllers\Api\CategoryController::class, 'destroy'])
        ->middleware('can:category_delete');
});
