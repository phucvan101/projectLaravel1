<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // Danh sách sản phẩm (xem tất cả)
    Route::get('products', [App\Http\Controllers\Api\ProductController::class, 'index'])
        ->middleware('can:product_list');

    // Xem chi tiết sản phẩm
    Route::get('products/{product}', [App\Http\Controllers\Api\ProductController::class, 'show'])
        ->middleware('can:product_list');

    // Thêm sản phẩm
    Route::post('products', [App\Http\Controllers\Api\ProductController::class, 'store'])
        ->middleware('can:product_add');

    // Sửa sản phẩm
    Route::post('products/{product}', [App\Http\Controllers\Api\ProductController::class, 'update'])
        ->middleware('can:product_edit');


    // Xóa sản phẩm
    Route::delete('products/{product}', [App\Http\Controllers\Api\ProductController::class, 'destroy'])
        ->middleware('can:product_delete');
});
