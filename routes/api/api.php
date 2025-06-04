<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// api routes for products
Route::resource('products', 'App\Http\Controllers\Api\ProductController')
    ->only(['index', 'show', 'store', 'update', 'destroy']);


// api routes for categories
Route::resource('categories', 'App\Http\Controllers\Api\CategoryController')
    ->only(['index', 'show', 'store', 'update', 'destroy']);

// api routes for search orders
Route::get('orders/search', [App\Http\Controllers\Api\OrderController::class, 'search']); // Laravel sẽ ưu tiên các route khớp tĩnh sau cùng, còn các route có tham số động (ví dụ {order}) sẽ được ưu tiên trước nếu viết ở trên trong file route. nếu không thì sẽ lỗi 404.
// api routes for filter orders
Route::get('orders/filter', [App\Http\Controllers\Api\OrderController::class, 'filter']);

// api routes for orders 
Route::resource('orders', 'App\Http\Controllers\Api\OrderController')
    ->only(['index', 'show', 'update', 'destroy']);

// api routes for order details
Route::put('orders/{idOrder}/cart/{idCart}', [App\Http\Controllers\Api\OrderController::class, 'updateCart']);
Route::delete('orders/{idOrder}/cart/{idCart}', [App\Http\Controllers\Api\OrderController::class, 'deleteCart']);
