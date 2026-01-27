<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\HomeBannerController;
use App\Http\Controllers\WorkStepController;
use App\Http\Controllers\NewsletterSubscriberController;
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
       Route::resource('currencies', CurrencyController::class);
      Route::resource('news', NewsController::class);
Route::resource('categories', CategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
    
Route::delete('products/{product}/images/{image}', [ProductController::class, 'destroyImage'])
    ->name('products.images.destroy');

Route::patch('products/{product}/images/{image}/main', [ProductController::class, 'setMainImage'])
    ->name('products.images.main');
    // Products extra actions
Route::patch('products/{product}/publish', [ProductController::class,'publish'])->name('products.publish');
Route::patch('products/{product}/unpublish', [ProductController::class,'unpublish'])->name('products.unpublish');

Route::get('products/{product}/price', [ProductController::class,'editPrice'])->name('products.price.edit');
Route::patch('products/{product}/price', [ProductController::class,'updatePrice'])->name('products.price.update');

Route::get('products/{product}/stock', [ProductController::class,'editStock'])->name('products.stock.edit');
Route::patch('products/{product}/stock', [ProductController::class,'updateStock'])->name('products.stock.update');

// Categories sort
Route::get('categories-sort', [CategoryController::class,'sort'])->name('categories.sort');
Route::patch('categories-sort', [CategoryController::class,'updateSort'])->name('categories.sort.update');
Route::post('products/bulk', [ProductController::class, 'bulk'])->name('products.bulk');

Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::post('products/{product}/duplicate', [ProductController::class, 'duplicate'])->name('products.duplicate');
  Route::resource('home-banners', HomeBannerController::class);
 Route::get('work-steps', [WorkStepController::class,'index'])
      ->name('work_steps.index');

  Route::get('work-steps/edit', [WorkStepController::class,'edit'])
      ->name('work_steps.edit');

  Route::put('work-steps', [WorkStepController::class,'update'])
      ->name('work_steps.update');
        Route::get('newsletter/subscribers', [NewsletterSubscriberController::class,'index'])
    ->name('newsletter_subscribers.index');

  Route::patch('newsletter/subscribers/{id}/toggle', [NewsletterSubscriberController::class,'toggle'])
    ->name('newsletter_subscribers.toggle');


});
 
//frontend routes


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::post('/change-currency/{code}', [HomeController::class, 'changeCurrency'])
    ->name('currency.change');
Route::post('/change-language/{locale}', [HomeController::class, 'changeLang'])
    ->name('language.change');
    Route::post('/newsletter/subscribe', [HomeController::class,'subscribe'])
  ->name('newsletter.subscribe');


