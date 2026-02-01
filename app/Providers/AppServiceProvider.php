<?php

namespace App\Providers;
use App\Models\Currency;
use App\Models\Setting;
use App\Services\CurrencyService;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\ServiceProvider;


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
      view()->composer('*', function ($view) {
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
            'currencies' => CurrencyService::all(),
            'currentCurrency' => CurrencyService::current(),
        
            'phone'    => Setting::get('phone'),
            'email'    => Setting::get('email'),
            'facebook' => Setting::get('facebook'),
            'instagram'=> Setting::get('instagram'),
            'snapchat'  => Setting::get('snapchat'),
             'tiktok'  => Setting::get('tiktok'),
            'whatsapp' => Setting::get('whatsapp'),
        
        ]);
    });
    }
}
