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

require __DIR__ . '/authApi.php';
require __DIR__ . '/productsApi.php';
require __DIR__ . '/categoriesApi.php';
require __DIR__ . '/ordersApi.php';
require __DIR__ . '/sliderApi.php';
require __DIR__ . '/rolesApi.php';
