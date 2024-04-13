<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            
            DB::table("users")->insert([
                "full_name"=> "Vendor",
                "user_name"=>"Vendor",
                "email"=> "Vendor@example.com",
                "password"=> Hash::make("1234"),
                "role"=> "vendor",

            ]);
            DB::table("users")->insert([
                "full_name"=> "User",
                "user_name"=>"User",
                "email"=> "User@example.com",
                "password"=> Hash::make("1234"),
                "role"=> "user",
            ]);
    }
}
