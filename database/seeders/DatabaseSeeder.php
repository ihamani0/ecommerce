<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('model_has_roles')->insert([
            'role_id' => 1 ,
            'model_type' => 'App\Models\Admin' ,
            'model_id' => 1
        ]);
        /*$this->call([
            UserSeeder::class,
            AdmintableSeeder::class ,
            PermissionSeeder::class ,
            RoleSeeder::class
        ]);*/
    }
}
