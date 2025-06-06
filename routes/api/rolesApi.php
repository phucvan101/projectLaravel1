<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('roles', [App\Http\Controllers\Api\RoleController::class, 'index'])->middleware('can:role_list');

    Route::post('roles', [App\Http\Controllers\Api\RoleController::class, 'store'])->middleware('can:role_add');

    Route::get('roles/{id}', [App\Http\Controllers\Api\RoleController::class, 'show']);

    Route::post('roles/{id}', [App\Http\Controllers\Api\RoleController::class, 'update'])->middleware('can:role_edit');

    Route::delete('roles/{id}', [App\Http\Controllers\Api\RoleController::class, 'destroy'])->middleware('can:role_delete');
});
