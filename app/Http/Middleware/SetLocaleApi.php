<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocaleApi
{
    public function handle(Request $request, Closure $next)
    {
        
        $lang = $request->header('X-Lang')
            ?? $request->get('lang')
            ?? $request->input('lang');

        if (!$lang && $request->user()) {
            $lang = $request->user()->lang;
        }

        $lang = $lang ?: config('app.locale', 'ar');

       
        $allowed = ['ar', 'en'];
        if (!in_array($lang, $allowed, true)) {
            $lang = config('app.fallback_locale', 'en');
        }

        app()->setLocale($lang);

        return $next($request);
    }
}
