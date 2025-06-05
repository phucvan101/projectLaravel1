<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', App\Http\Controllers\Api\ProductController::class)
        ->only(['index', 'show', 'store', 'update', 'destroy']);
});
