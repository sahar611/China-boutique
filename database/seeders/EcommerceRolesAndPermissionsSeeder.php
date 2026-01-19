<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class EcommerceRolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        
        app(PermissionRegistrar::class)->forgetCachedPermissions();

     
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();

       
        Permission::query()->delete();
        Role::query()->delete();

        
        $permissions = [

            // Admin access
            'admin.access',

            // Dashboard
            'dashboard.view',

            // Users
            'users.view','users.create','users.edit','users.delete','users.block',

            // Roles & Permissions
            'roles.view','roles.create','roles.edit','roles.delete',
            'permissions.manage',

            // Products
            'products.view','products.create','products.edit','products.delete',
            'products.publish','products.unpublish',
            'products.price_edit','products.stock_edit',
            'products.images_manage',

            // Categories
            'categories.view','categories.create','categories.edit','categories.delete','categories.sort',

            // Brands
            'brands.view','brands.create','brands.edit','brands.delete',

            // Orders
            'orders.view','orders.update_status','orders.cancel',
            'orders.refund','orders.invoice','orders.export','orders.notes',

            // Shipping
            'shipping.view','shipping.update_tracking',

            // Payments
            'payments.view','payments.refund',

            // Coupons
            'coupons.view','coupons.create','coupons.edit','coupons.delete','coupons.enable_disable',

            // Pages (CMS)
            'pages.view','pages.create','pages.edit','pages.delete','pages.publish',

            // Banners / Sliders
            'banners.view','banners.create','banners.edit','banners.delete',

            // Reviews
            'reviews.view','reviews.approve','reviews.delete','reviews.reply',

            // Customers
            'customers.view','customers.edit','customers.export',

            // Settings
            'settings.view','settings.edit',

            // Audit / Logs
            'audit.view',
            // Currencies
'currencies.view','currencies.create','currencies.edit','currencies.delete','currencies.set_default',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

       
        $superAdmin = Role::firstOrCreate([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);
        $superAdmin->syncPermissions($permissions);

        // Store Admin
        $storeAdmin = Role::firstOrCreate([
            'name' => 'store-admin',
            'guard_name' => 'web',
        ]);
        $storeAdmin->syncPermissions([
            'admin.access',
            'dashboard.view',

            'products.view','products.create','products.edit','products.delete',
            'products.publish','products.unpublish','products.price_edit','products.stock_edit','products.images_manage',

            'categories.view','categories.create','categories.edit','categories.delete','categories.sort',
            'brands.view','brands.create','brands.edit','brands.delete',

            'orders.view','orders.update_status','orders.cancel','orders.invoice','orders.notes','orders.export',
            'shipping.view','shipping.update_tracking',

            'coupons.view','coupons.create','coupons.edit','coupons.delete','coupons.enable_disable',

            'pages.view','pages.create','pages.edit','pages.delete','pages.publish',
            'banners.view','banners.create','banners.edit','banners.delete',

            'reviews.view','reviews.approve','reviews.delete',
            'customers.view','customers.edit',

            'settings.view',
            'currencies.view','currencies.create','currencies.edit','currencies.delete','currencies.set_default',

        ]);

        // Order Manager
        $orderManager = Role::firstOrCreate([
            'name' => 'order-manager',
            'guard_name' => 'web',
        ]);
        $orderManager->syncPermissions([
            'admin.access',
            'dashboard.view',
            'orders.view','orders.update_status','orders.cancel','orders.invoice','orders.notes',
            'shipping.view','shipping.update_tracking',
            'customers.view','currencies.view',

        ]);

        // Content Manager
        $contentManager = Role::firstOrCreate([
            'name' => 'content-manager',
            'guard_name' => 'web',
        ]);
        $contentManager->syncPermissions([
            'admin.access',
            'products.view','products.create','products.edit','products.publish','products.unpublish','products.images_manage',
            'categories.view','categories.create','categories.edit','categories.sort',
            'brands.view','brands.create','brands.edit',
            'pages.view','pages.create','pages.edit','pages.publish',
            'banners.view','banners.create','banners.edit',
        ]);

        // Warehouse
        $warehouse = Role::firstOrCreate([
            'name' => 'warehouse',
            'guard_name' => 'web',
        ]);
        $warehouse->syncPermissions([
            'admin.access',
            'orders.view','orders.update_status',
            'products.stock_edit',
            'shipping.view','shipping.update_tracking',
        ]);

        // Finance
        $finance = Role::firstOrCreate([
            'name' => 'finance',
            'guard_name' => 'web',
        ]);
        $finance->syncPermissions([
            'admin.access',
            'payments.view','payments.refund',
            'orders.view','orders.refund','orders.export',
            'audit.view',
        ]);

        // Support
        $support = Role::firstOrCreate([
            'name' => 'support',
            'guard_name' => 'web',
        ]);
        $support->syncPermissions([
            'admin.access',
            'orders.view','orders.notes',
            'customers.view',
            'reviews.view','reviews.reply',
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
