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
