<?php

namespace App\Providers;
use App\Models\Currency;
use App\Models\Setting;
use App\Services\CurrencyService;
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
