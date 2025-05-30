<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderAdminController;


Route::prefix('orders')->group(function () {
    Route::get('/', [OrderAdminController::class, 'index'])->name('orders.index')->middleware('can:order_list');

    // search orders
    Route::get('/search', [OrderAdminController::class, 'search'])->name('orders.search');

    // Filter orders by status
    Route::get('/filter', [OrderAdminController::class, 'filterByStatus'])->name('orders.filterByStatus');

    // route detail
    Route::get('/detail/{id}', [OrderAdminController::class, 'detail'])->name('orders.detail');

    // route edit
    Route::get('/edit/{id}', [OrderAdminController::class, 'edit'])->name('orders.edit')->middleware('can:order_edit,id');

    // route update cart 
    Route::post('/edit/{idOrder}/update-cart', [OrderAdminController::class, 'updateCart'])->name('orders.updateCart');

    // route delete product in cart
    Route::get('/edit/{idOrder}/delete-cart/{idOrderDetail}', [OrderAdminController::class, 'deleteCart'])->name('orders.deleteCart');

    // route update order
    Route::post('/update/{id}', [OrderAdminController::class, 'updateOrder'])->name('orders.updateOrder');

    // route delete
    Route::get('/delete/{id}', [OrderAdminController::class, 'delete'])->name('orders.delete')->middleware('can:order_delete');
});
