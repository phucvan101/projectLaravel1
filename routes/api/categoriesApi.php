<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('categories', App\Http\Controllers\Api\CategoryController::class)
        ->only(['index', 'show', 'store', 'update', 'destroy']);
});
