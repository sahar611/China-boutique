<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SettingController;


use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;

Route::get('/sing-in', [AuthController::class, 'login'])->name('login');
Route::get('/sing-up', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'checklogin'])->name('checklogin');

Route::get('lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ar'])) {
        session(['locale' => $lang]);
    }
    return back();
})->name('lang.switch');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// ------------------- ADMIN AREA -------------------
Route::middleware(['auth', 'permission:admin.access'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', [MainController::class, 'index'])
            ->name('home')
            ->middleware('permission:dashboard.view');

 
        Route::resource('users', UserController::class)
            ->middleware('role:super-admin');

    
        Route::resource('roles', RoleController::class)
            ->middleware('role:super-admin');

        // Banners
        Route::resource('banners', BannerController::class);
        // Pages
        Route::resource('pages', PageController::class);

        // Settings
        Route::get('settings', [SettingController::class, 'edit'])
            ->name('settings.edit');
        Route::post('settings', [SettingController::class, 'update'])
            ->name('settings.update');

     

        // Products
        Route::resource('products', ProductController::class);
        Route::post('products/{product}/publish', [ProductController::class, 'publish'])
            ->name('products.publish');
        Route::post('products/{product}/unpublish', [ProductController::class, 'unpublish'])
            ->name('products.unpublish');

        // Categories
        Route::resource('categories', CategoryController::class);

        // Brands
        Route::resource('brands', BrandController::class);

        // Orders
        Route::resource('orders', OrderController::class)->only(['index','show','destroy']);
        Route::post('orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.update_status');
        Route::post('orders/{order}/cancel', [OrderController::class, 'cancel'])
            ->name('orders.cancel');
        Route::post('orders/{order}/refund', [OrderController::class, 'refund'])
            ->name('orders.refund');
    });
