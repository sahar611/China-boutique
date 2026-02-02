<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\WorkshopType;
use Illuminate\Support\Facades\Storage;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use App\Models\ProviderCertificate;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
  
   public function index()
{
    $baseQuery = User::orderByDesc('id');

    return view('users.index', [
        'users'     => (clone $baseQuery)->get(),
        'customers' => (clone $baseQuery)->where('account_type', 'customer')->get(),
        'staff'     => (clone $baseQuery)->where('account_type', 'staff')->get(),
    ]);
}




  
   
    public function create()
    {
      
        return view('users.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name'         => 'required|string|max:255',
        'email'        => 'required|email|unique:users,email',
        'password'     => 'required|min:6',
        'account_type' => 'required|in:customer,staff',
        'role'         => 'nullable|string', 
        'phone'        => 'nullable|string|max:20',
        'picture'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'verified'     => 'nullable|boolean',
        'status'       => 'nullable|in:0,1',
    ]);

    
    if ($request->account_type === 'staff' && !$request->filled('role')) {
        return back()->withErrors(['role' => 'Role is required for staff users'])->withInput();
    }

    $picturePath = null;
    if ($request->hasFile('picture')) {
    $file = $request->file('picture');
    $filename = time().'_'.$file->getClientOriginalName();
    $file->move(public_path('uploads/pictures'), $filename);

    $picturePath = 'uploads/pictures/'.$filename;
}


    $user = User::create([
        'name'         => $request->name,
        'email'        => $request->email,
        'password'     => Hash::make($request->password),
        'account_type' => $request->account_type,
        'phone'        => $request->phone,
        'verified'     => $request->verified ?? 0,
        'status'       => $request->status ?? 1,
        'picture'      => $picturePath,
    ]);

    // Role assignment
    if ($request->account_type === 'staff') {
        $user->assignRole($request->role);
    } 
    // else {
       
    //     $user->assignRole('customer');
    // }

    return redirect()->route('admin.users.index')->with('success', 'User created successfully');
}



    
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

   
    public function edit(User $user)
    {
        
        return view('users.edit', compact('user'));
    }

   
 public function update(Request $request, User $user)
{
    $request->validate([
        'name'         => 'nullable|string|max:255',
        'email'        => 'nullable|email|unique:users,email,' . $user->id,
        'password'     => 'nullable|min:6',
        'account_type' => 'nullable|in:customer,staff',
        'role'         => 'nullable|string',
        'phone'        => 'nullable|string|max:20',
        'verified'     => 'nullable|boolean',
        'status'       => 'nullable|in:0,1',
        'picture'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only([
        'name','email','phone','verified','status','account_type'
    ]);

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

   if ($request->hasFile('picture')) {

    
    if ($user->picture && File::exists(public_path($user->picture))) {
        File::delete(public_path($user->picture));
    }

   
    $file = $request->file('picture');
    $filename = time().'_'.$file->getClientOriginalName();
    $file->move(public_path('uploads/pictures'), $filename);

   
    $data['picture'] = 'uploads/pictures/'.$filename;
}
    $user->update($data);

   
    $newAccountType = $request->input('account_type', $user->account_type);

    if ($newAccountType === 'staff') {
        if ($request->filled('role')) {
            $user->syncRoles([$request->role]);
        }
    } else {
        
        $user->syncRoles(['customer']);
    }

    return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
}


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
     
}
