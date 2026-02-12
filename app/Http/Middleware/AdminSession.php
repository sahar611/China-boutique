<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminSession
{
    public function handle($request, Closure $next)
    {
        // فصل كوكي السيشن للأدمن
        config(['session.cookie' => config('session.cookie') . '_admin']);

        // ✅ الأهم: اجبري Laravel يستخدم guard admin في كل طلبات /admin
        Auth::shouldUse('admin');

        return $next($request);
    }
}
