<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use DB;

 
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Role::paginate(20);
        return view('roles.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    $permissions = Permission::orderBy('name')->get()->groupBy(function ($perm) {
        return explode('.', $perm->name)[0]; // products.view => products
    });

    return view('roles.create', compact('permissions'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  



public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100|unique:roles,name',
        'permissions' => 'nullable|array',
    ]);

    $role = Role::create([
        'name' => $request->name,
        'guard_name' => 'web',
    ]);

    $role->syncPermissions($request->permissions ?? []);

    return redirect()->route('roles.index')->with('success', 'Role created successfully');
}



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
{
    $model = Role::findOrFail($id);

    $permissions = Permission::orderBy('name')->get()->groupBy(function ($perm) {
        return explode('.', $perm->name)[0];
    });

    $rolePermissionNames = $model->permissions->pluck('name')->toArray();

    return view('roles.edit', compact('model', 'permissions', 'rolePermissionNames'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request, $id)
{
    $role = \Spatie\Permission\Models\Role::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:100|unique:roles,name,' . $role->id,
        'permissions' => 'nullable|array',
    ]);

    $role->update(['name' => $request->name]);

    $role->syncPermissions($request->permissions ?? []);

    return redirect()->route('roles.index')->with('success', 'Role updated successfully');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        // $role->revokePermissionTo($permissions);
        $role->delete();
        $permissions =auth()->user()->getAllPermissions();;
        $role->revokePermissionTo($permissions);
      
        return redirect(route('roles.index'))->with('error','Role deleted successfully!');
    }
}
