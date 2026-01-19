<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'web';

      
       DB::table('role_has_permissions')->delete();
        DB::table('model_has_permissions')->delete();
        DB::table('model_has_roles')->delete();
        DB::table('permissions')->delete();
        DB::table('roles')->delete();

       
        $permissions = [
            'manage users',
            'manage roles',
            'manage workshops',
            'manage workshop types',
            'manage countries',
            'manage cities',
            'manage banners',
            'manage settlements',
            'manage bookings',
            'manage payments',

            'manage pages',
            'manage faqs',
            'manage settings',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate([
                'name'       => $perm,
                'guard_name' => $guard,
            ]);
        }

        
        $adminRole    = Role::firstOrCreate(['name' => 'admin', 'guard_name' => $guard]);
        $providerRole = Role::firstOrCreate(['name' => 'provider', 'guard_name' => $guard]);
        $clientRole   = Role::firstOrCreate(['name' => 'client', 'guard_name' => $guard]);

       
        $adminRole->syncPermissions(Permission::all());

       
        $providerPerms = [
            'manage workshops',     
            'manage settlements',   
            'manage bookings',     
        ];

        $providerRole->syncPermissions($providerPerms);

     
        User::where('user_type', 'admin')->each(function ($user) use ($adminRole) {
            $user->syncRoles([$adminRole->name]);
        });

        User::where('user_type', 'provider')->each(function ($user) use ($providerRole) {
            $user->syncRoles([$providerRole->name]);
        });

        User::where('user_type', 'client')->each(function ($user) use ($clientRole) {
            $user->syncRoles([$clientRole->name]);
        });

      
        $firstUser = User::first();
        if ($firstUser && ! $firstUser->hasRole('admin')) {
            $firstUser->syncRoles([$adminRole->name]);
        }
    }
}

