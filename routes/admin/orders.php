<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderAdminController;


Route::prefix('orders')->group(function () {
    Route::get('/', [OrderAdminController::class, 'index'])->name('orders.index');
    // Route::get('/search', [OrderAdminController::class, 'search'])->name('orders.search');
});
