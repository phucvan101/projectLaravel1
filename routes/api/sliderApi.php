<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SliderController;

Route::middleware('auth:sanctum')->group(function () {
    // Danh sách slider (xem tất cả)
    Route::get('sliders', [SliderController::class, 'index'])
        ->middleware('can:slider_list');

    // Xem chi tiết slider
    Route::get('sliders/{slider}', [SliderController::class, 'show']);

    // Thêm slider
    Route::post('sliders', [SliderController::class, 'store'])
        ->middleware('can:slider_add');

    // Sửa slider
    Route::post('sliders/{slider}', [SliderController::class, 'update'])
        ->middleware('can:slider_edit');

    // Xóa slider
    Route::delete('sliders/{slider}', [SliderController::class, 'destroy'])
        ->middleware('can:slider_delete');
});
