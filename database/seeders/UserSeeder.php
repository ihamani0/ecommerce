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
                "name"=> "Vendor",
                "username"=>"Vendor",
                "email"=> "vendor@vendor.com",
                "password"=> Hash::make("1234"),
                "role"=> "vendor",
                "email_verified_at"=>now()

            ]);
            DB::table("users")->insert([
                "name"=> "User",
                "username"=>"User",
                "email"=> "user@user.com",
                "password"=> Hash::make("1234"),
                "role"=> "user",
                "email_verified_at"=>now()
            ]);
    }
}
