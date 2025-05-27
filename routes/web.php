<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/admin', 'App\Http\Controllers\AdminController@loginAdmin');
Route::post('/admin', 'App\Http\Controllers\AdminController@postLoginAdmin');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/admin');
})->name('logout');

Route::get('/home', function () {
    return view('home');
});


// Route: admin
Route::prefix('admin')->group(function () {
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
