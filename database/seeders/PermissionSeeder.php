<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $Permissions = [
             // Brand permissions
             ['name' => 'view brand', 'group' => 'brand', 'guard_name' => 'admin'],
             ['name' => 'add brand', 'group' => 'brand', 'guard_name' => 'admin'],
             ['name' => 'update brand', 'group' => 'brand', 'guard_name' => 'admin'],
             ['name' => 'delete brand', 'group' => 'brand', 'guard_name' => 'admin'],
             // Category permissions
             ['name' => 'view category', 'group' => 'category', 'guard_name' => 'admin'],
             ['name' => 'add category', 'group' => 'category', 'guard_name' => 'admin'],
             ['name' => 'update category', 'group' => 'category', 'guard_name' => 'admin'],
             ['name' => 'delete category', 'group' => 'category', 'guard_name' => 'admin'],
             // Subcategory permissions
             ['name' => 'view subcategory', 'group' => 'subcategory', 'guard_name' => 'admin'],
             ['name' => 'add subcategory', 'group' => 'subcategory', 'guard_name' => 'admin'],
             ['name' => 'update subcategory', 'group' => 'subcategory', 'guard_name' => 'admin'],
             ['name' => 'delete subcategory', 'group' => 'subcategory', 'guard_name' => 'admin'],
             // Product permissions
             ['name' => 'view product', 'group' => 'product', 'guard_name' => 'admin'],
             ['name' => 'add product', 'group' => 'product', 'guard_name' => 'admin'],
             ['name' => 'update product', 'group' => 'product', 'guard_name' => 'admin'],
             ['name' => 'delete product', 'group' => 'product', 'guard_name' => 'admin'],
             // Stock permissions
             ['name' => 'view stock', 'group' => 'stock', 'guard_name' => 'admin'],
             ['name' => 'add stock', 'group' => 'stock', 'guard_name' => 'admin'],
             ['name' => 'update stock', 'group' => 'stock', 'guard_name' => 'admin'],
             ['name' => 'delete stock', 'group' => 'stock', 'guard_name' => 'admin'],
             // Coupon permissions
             ['name' => 'view coupon', 'group' => 'coupon', 'guard_name' => 'admin'],
             ['name' => 'add coupon', 'group' => 'coupon', 'guard_name' => 'admin'],
             ['name' => 'update coupon', 'group' => 'coupon', 'guard_name' => 'admin'],
             ['name' => 'delete coupon', 'group' => 'coupon', 'guard_name' => 'admin'],
             ['name' => 'change-status coupon', 'group' => 'coupon', 'guard_name' => 'admin'],
             // Vendor Manage permissions
             ['name' => 'view vendor', 'group' => 'vendor', 'guard_name' => 'admin'],
             ['name' => 'change-status vendor', 'group' => 'vendor', 'guard_name' => 'admin'],
             // Order permissions
             ['name' => 'view order', 'group' => 'order', 'guard_name' => 'admin'],
             ['name' => 'change-status order', 'group' => 'order', 'guard_name' => 'admin'],
             // Order Return permissions
             ['name' => 'view order-return', 'group' => 'order', 'guard_name' => 'admin'],
             ['name' => 'change-status order-return', 'group' => 'order', 'guard_name' => 'admin'],
             // User Manage permissions
             ['name' => 'view user-vendor', 'group' => 'user-management', 'guard_name' => 'admin'],
             ['name' => 'change-status user-vendor', 'group' => 'user-management', 'guard_name' => 'admin'],
             // Permissions permissions
             ['name' => 'view permissions', 'group' => 'permissions', 'guard_name' => 'admin'],
             ['name' => 'add permissions', 'group' => 'permissions', 'guard_name' => 'admin'],
             ['name' => 'update permissions', 'group' => 'permissions', 'guard_name' => 'admin'],
             ['name' => 'delete permissions', 'group' => 'permissions', 'guard_name' => 'admin'],
             // Role permissions
             ['name' => 'view role', 'group' => 'role', 'guard_name' => 'admin'],
             ['name' => 'add role', 'group' => 'role', 'guard_name' => 'admin'],
             ['name' => 'update role', 'group' => 'role', 'guard_name' => 'admin'],
             ['name' => 'delete role', 'group' => 'role', 'guard_name' => 'admin'],
             // Review permissions
             ['name' => 'view review', 'group' => 'review', 'guard_name' => 'admin'],
             ['name' => 'change-status review', 'group' => 'review', 'guard_name' => 'admin'],
             // Report permissions
             ['name' => 'view report', 'group' => 'report', 'guard_name' => 'admin'],
             // Banner permissions
             ['name' => 'view banner', 'group' => 'banner', 'guard_name' => 'admin'],
             ['name' => 'add banner', 'group' => 'banner', 'guard_name' => 'admin'],
             ['name' => 'update banner', 'group' => 'banner', 'guard_name' => 'admin'],
             ['name' => 'delete banner', 'group' => 'banner', 'guard_name' => 'admin'],
             // Slider permissions
             ['name' => 'view slider', 'group' => 'slider', 'guard_name' => 'admin'],
             ['name' => 'add slider', 'group' => 'slider', 'guard_name' => 'admin'],
             ['name' => 'update slider', 'group' => 'slider', 'guard_name' => 'admin'],
             ['name' => 'delete slider', 'group' => 'slider', 'guard_name' => 'admin'],
             // Config permissions
             ['name' => 'view config', 'group' => 'config', 'guard_name' => 'admin'],
             ['name' => 'add config', 'group' => 'config', 'guard_name' => 'admin'],
             ['name' => 'update config', 'group' => 'config', 'guard_name' => 'admin'],
             ['name' => 'delete config', 'group' => 'config', 'guard_name' => 'admin'],
         ];

        foreach ($Permissions  as $permission) {
            Permission::create($permission);
        }
    }
}
