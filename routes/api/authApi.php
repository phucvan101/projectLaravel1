<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Public authentication routes
Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);

// Protected authentication routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
