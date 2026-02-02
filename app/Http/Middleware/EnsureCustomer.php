<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureCustomer
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->account_type !== 'customer') {
            return redirect()->route('customer.login');
        }
        return $next($request);
    }
}
