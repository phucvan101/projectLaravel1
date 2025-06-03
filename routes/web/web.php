<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Route::get('/admin', 'App\Http\Controllers\AdminController@loginAdmin')->name('login');
Route::post('/admin', 'App\Http\Controllers\AdminController@postLoginAdmin');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/admin');
})->name('logout');

Route::get('/home', [HomeController::class, 'home'])->middleware('auth')->name('home');


// Route: admin
Route::prefix('admin')->middleware('auth')->group(function () {
    // Route: Categories
    require __DIR__ . '/admin/categories.php';


    // Route: Menus
    require __DIR__ . '/admin/menus.php';

    // Route: Product
    require __DIR__ . '/admin/products.php';



    // Route: slider
    require __DIR__ . '/admin/sliders.php';


    // Route: setting
    require __DIR__ . '/admin/settings.php';


    // Route: users
    require __DIR__ . '/admin/users.php';


    // Route: role
    require __DIR__ . '/admin/roles.php';



    // route: permission
    require __DIR__ . '/admin/permissions.php';

    // route: orders
    require __DIR__ . '/admin/orders.php';
});
