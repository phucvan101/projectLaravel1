<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('orders/search', [App\Http\Controllers\Api\OrderController::class, 'search']);
    Route::get('orders/filter', [App\Http\Controllers\Api\OrderController::class, 'filter']);
    Route::apiResource('orders', App\Http\Controllers\Api\OrderController::class)
        ->only(['index', 'show', 'destroy']);
    Route::post('orders/{id}', [App\Http\Controllers\Api\OrderController::class, 'update']);
    Route::post('orders/{idOrder}/cart/{idCart}', [App\Http\Controllers\Api\OrderController::class, 'updateCart']);
    Route::delete('orders/{idOrder}/cart/{idCart}', [App\Http\Controllers\Api\OrderController::class, 'deleteCart']);
});
