<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
{
    if (!Auth::guard('admin')->check() || Auth::guard('admin')->user()->account_type !== 'staff') {
        return redirect()->route('admin.login'); 
    }
    return $next($request);
}

}
