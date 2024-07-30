<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $super_admin = Role::create(['name' => 'super-admin', 'guard_name' => 'admin']);

        $super_admin->givePermissionTo(Permission::all());

        DB::table('model_has_roles')->insert([
            'role_id' => 1 ,
            'model_type' => 'App\Models\Admin' ,
            'model_id' => 1
        ]);
    }
}
