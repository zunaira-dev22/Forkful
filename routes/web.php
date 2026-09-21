<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerOrderController;

use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\AdminDashboardController;


/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', [MenuController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::post('/cart/add/{menuItem}', [CartController::class, 'add'])
    ->name('cart.add');

Route::post('/cart/increase/{id}', [CartController::class, 'increase'])
    ->name('cart.increase');

Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])
    ->name('cart.decrease');


/*
|--------------------------------------------------------------------------
| GUEST AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

});


/*
|--------------------------------------------------------------------------
| ALL LOGGED-IN USERS
|--------------------------------------------------------------------------
|
| Admin aur Customer dono logout kar sakte hain.
|
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});


/*
|--------------------------------------------------------------------------
| CUSTOMER ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'customer'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    Route::get('/checkout', [OrderController::class, 'checkout'])
        ->name('checkout');


    /*
    |--------------------------------------------------------------------------
    | PLACE ORDER
    |--------------------------------------------------------------------------
    */

    Route::post('/orders', [OrderController::class, 'store'])
        ->name('orders.store');


    /*
    |--------------------------------------------------------------------------
    | CUSTOMER ORDERS
    |--------------------------------------------------------------------------
    */

    Route::get('/my-orders', [CustomerOrderController::class, 'index'])
        ->name('customer.orders.index');


    Route::get('/my-orders/{order}', [CustomerOrderController::class, 'show'])
        ->name('customer.orders.show');


    Route::patch(
        '/my-orders/{order}/cancel',
        [CustomerOrderController::class, 'cancel']
    )->name('customer.orders.cancel');

});


/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | ADMIN DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/dashboard',
            [AdminDashboardController::class, 'index']
        )->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | MENU CRUD
        |--------------------------------------------------------------------------
        */

        Route::resource(
    'menu-items',
    MenuItemController::class
)->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | ADMIN ORDERS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/orders',
            [AdminOrderController::class, 'index']
        )->name('admin.orders.index');

        Route::get(
        '/orders/{order}',
         [AdminOrderController::class, 'show']
    )->name('admin.orders.show');

        Route::patch(
            '/orders/{order}/status',
            [AdminOrderController::class, 'updateStatus']
        )->name('admin.orders.status');


        /*
        |--------------------------------------------------------------------------
        | CUSTOMERS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/customers',
            [CustomerController::class, 'index']
        )->name('admin.customers.index');

    });