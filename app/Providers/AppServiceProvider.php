<?php

namespace App\Providers;
use App\Models\Currency;
use App\Models\Setting;
use App\Services\CurrencyService;
use App\Models\Category;
use App\Models\Brand;
use App\Models\News;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    
public function boot(): void
{
    view()->composer('front.*', function ($view) {
       
         if (Auth::guard('web')->check()) {
            $wishlistCount = Auth::guard('web')->user()->wishlistProducts()->count();
        } else {
            $ids = session('wishlist', []);
            $wishlistCount = is_array($ids) ? count($ids) : 0;
        }

        $cartItems = session('cart.items', []);
        $cartCount = is_array($cartItems) ? array_sum(array_column($cartItems, 'qty')) : 0;

        $view->with([
            'headerDropdownCategories' => Category::query()
                ->where('is_active', 1)
                ->where('is_featured', 1)
                ->whereJsonContains('positions', 'header_dropdown')
                ->orderBy('home_sort')
                ->orderBy('sort_order')
                ->limit(10)
                ->get(),

            'homeSidebarCategories' => Category::query()
                ->where('is_active', 1)
                ->where('is_featured', 1)
                ->whereJsonContains('positions', 'home_sidebar')
                ->orderBy('home_sort')
                ->orderBy('sort_order')
                ->limit(10)
                ->get(),

            'topBrands' => Brand::query()
                ->where('is_active', 1)
                ->where('is_featured', 1)
                ->withCount([
                    'products' => function ($q) {
                        $q->where('is_active', 1);
                    }
                ])
                ->orderBy('home_sort')
                ->orderBy('sort_order')
                ->limit(6)
                ->get(),

            'currencies'      => CurrencyService::all(),
            'currentCurrency' => CurrencyService::current(),

            'phone'     => Setting::get('phone'),
            'email'     => Setting::get('email'),
            'facebook'  => Setting::get('facebook'),
            'instagram' => Setting::get('instagram'),
            'snapchat'  => Setting::get('snapchat'),
            'tiktok'    => Setting::get('tiktok'),
            'whatsapp'  => Setting::get('whatsapp'),
            'last_news' => News::where('is_published', 1)->orderByDesc('published_at') ->limit(3)->get(),
            
            'wishlistCount' => $wishlistCount,
            'cartCount'     => $cartCount,
        ]);
    });
}
}