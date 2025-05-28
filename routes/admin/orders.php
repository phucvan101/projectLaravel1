<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderAdminController;


Route::prefix('orders')->group(function () {
    Route::get('/', [OrderAdminController::class, 'index'])->name('orders.index');

    Route::get('/search', [OrderAdminController::class, 'search'])->name('orders.search');
    // route detail
    Route::get('/detail/{id}', [OrderAdminController::class, 'detail'])->name('orders.detail');
    // route edit
    Route::get('/edit/{id}', [OrderAdminController::class, 'edit'])->name('orders.edit');
    // route update
    Route::post('/edit/{idOrder}/update-cart', [OrderAdminController::class, 'updateCart'])->name('orders.updateCart');
    Route::get('/edit/{idOrder}/delete-cart/{idOrderDetail}', [OrderAdminController::class, 'deleteCart'])->name('orders.deleteCart');
    Route::post('/update/{id}', [OrderAdminController::class, 'updateOrder'])->name('orders.updateOrder');

    // route delete
    Route::get('/delete/{id}', [OrderAdminController::class, 'delete'])->name('orders.delete');
});
