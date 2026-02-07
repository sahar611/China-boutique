<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;  

class AuthController extends Controller 
{
    
    public function logout(Request $request)
    {
        
                         $user = User::find(Auth::user()->id);


            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
    }
    
  public function login()
  {
    Log::info('login');
         if(Auth::user()) {
             
             $user = User::find(Auth::user()->id);
           
          
             $user->save();
             
             return  redirect()->route('admin.home'); 

         } else {
             return view('auth.login')->with('error' , 'الرجاء التحقق من بريدك الالكتروني و كلمة السر !');
         }
  }
  public function register()
  {
    
  }
 
      public function checkLogin(Request $request)
      {
           $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:4'
            ]);
        $credentials['account_type'] = 'staff';
               if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                              $user = Auth::getLastAttempted();
                              
                //  if ($user->status==0) {
                //     Auth::logout();
                //     return redirect()->route('login')->with('alert-success' , 'حسابك غير نشط انتظر التفعيل!..');
                //  } else{
                     
                         $user = User::find(Auth::user()->id);
                if ($user->hasRole('admin')) {
            return redirect()->route('admin.home');
       // }

        if ($user->hasRole('provider')) {
            return redirect()->route('provider.home');
        }
             
                        Auth::logout();
        return redirect()
            ->route('login')
            ->withErrors(['email' => 'لا تملك صلاحية للدخول.']);
                         
                   }
                  }
               return back()->with('alert-success', 'الرجاء التحقق من بريدك الالكتروني و كلمة السر!'); 

      }
 
  
}