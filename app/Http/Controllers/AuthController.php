<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        Log::info('admin login page');

       
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.home');
        }

        return view('auth.login');
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'account_type' => 'staff',
        ];

      if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
      
    $request->session()->regenerate();

    
    Auth::guard('web')->logout();

    $user = Auth::guard('admin')->user();

    if ($user->account_type == 'staff') {
        return redirect()->route('admin.home');
    }

    Auth::guard('admin')->logout();
    return redirect()->route('admin.login')
        ->withErrors(['email' => 'لا تملك صلاحية للدخول.']);
}


        return back()->withErrors([
            'email' => 'الرجاء التحقق من بريدك الالكتروني و كلمة السر!',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
