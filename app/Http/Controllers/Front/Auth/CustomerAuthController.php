<?php
namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function showLogin()
    {
        return view('front.auth.login');
    }
 public function showRegister()
    {
        return view('front.auth.register');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

  
       
$credentials['account_type'] = 'customer';
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            
            $ids = session('wishlist.items', []);
            if (is_array($ids) && !empty($ids)) {
                foreach ($ids as $productId) {
                    \App\Models\Wishlist::firstOrCreate([
                        'user_id' => auth()->id(),
                        'product_id' => $productId,
                    ]);
                }
                session()->forget('wishlist.items');
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => __('messages.invalid_credentials'),
        ])->withInput();
    }
 public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'phone' => ['nullable','string','max:20','unique:users,phone'],
            'password' => ['required','string','min:6','confirmed'],
        ]);

        $user = User::create([
            'name'         => $data['name'],
            'email'        => strtolower($data['email']),
            'phone'        => $data['phone'] ?? null,
            'password'     => Hash::make($data['password']),
            'account_type' => 'customer',  
            'status'       => 1,
            'verified'     => 0,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
