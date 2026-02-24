<?php
namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
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
    $guestSessionId = $request->session()->getId(); 

    $credentials = $request->validate([
        'email' => ['required','email'],
        'password' => ['required'],
    ]);

    $credentials['account_type'] = 'customer';

    if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {

      
        $request->session()->regenerate();

        Auth::guard('admin')->logout();

        app(\App\Services\CartService::class)->currentCart($request, $guestSessionId);

       
       
$ids = session('wishlist', []); 
$ids = is_array($ids) ? $ids : [];

if (!empty($ids)) {
    foreach ($ids as $productId) {
        \App\Models\Wishlist::firstOrCreate([
            'user_id'    => Auth::guard('web')->id(),
            'product_id' => $productId,
        ]);
    }
    session()->forget('wishlist'); 
}


        return redirect()->intended(route('home'));
    }

    return back()->withErrors([
        'email' => __('messages.invalid_credentials'),
    ])->withInput();
}

 public function register(Request $request)
    {
        $guestSessionId = $request->session()->getId();
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'phone' => ['nullable','string','max:20','unique:users,phone'],
            'password' => ['required','string','min:6','confirmed'],
             'address'  => ['nullable','string','max:255'], 
        ]);

        $user = User::create([
            'name'         => $data['name'],
            'email'        => strtolower($data['email']),
            'phone'        => $data['phone'] ?? null,
            'password'     => Hash::make($data['password']),
            'account_type' => 'customer',  
            'status'       => 1,
            'verified'     => 0,
              'address'      => $data['address'] ?? null,
        ]);

       Auth::guard('web')->login($user);
    $request->session()->regenerate();

    app(\App\Services\CartService::class)->currentCart($request, $guestSessionId);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
       Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
    public function edit()
    {
       $user = Auth::guard('web')->user();

        return view('front.auth.edit_profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('web')->user();

        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email','max:255','unique:users,email,' . $user->id],
            'phone'    => ['nullable','string','max:20','unique:users,phone,' . $user->id],
            'address'  => ['nullable','string','max:255'],
            'password' => ['nullable','confirmed','min:6'],
        ]);

        $user->name    = $data['name'];
        $user->email   = strtolower($data['email']);
        $user->phone   = $data['phone'] ?? null;
        $user->address = $data['address'] ?? null;

        
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return back()->with('success', __('Profile updated successfully'));
    }
    public function myOrders()
{
    $orders = Order::query()
        ->where('user_id', Auth::guard('web')->id())

        ->with(['items'])   
        ->withCount('items')         
        ->latest()
         ->paginate(10)
        ->withQueryString();
       

    return view('front.auth.orders', compact('orders'));
}

}
