<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\VendorInterface;
use App\Models\User;

class VendorRepo implements VendorInterface {
    // Define your class methods here
    public function getVendorsActive()
    {
        return User::where('role' , "vendor")
                    ->where('status' , true)
                        ->get();
    }

    public function getVendorsInActive()
    {
        return User::where('role' , "vendor")
                ->where('status' , false)
                    ->get();
    }

    public function getVendorDetails($id){
        return User::where('role' , "vendor")
                        ->where("id" , $id)->first();
    }

    public function ActiveVendor($id)
    {
        return User::where('role' , "vendor")
            ->where("id" , $id)
                ->update([
                    "status" => 1
                ]);
    }

    public function InActiveVendor($id)
    {
        return User::where('role' , "vendor")
                ->where("id" , $id)
                    ->update([
                        "status" => 0
                    ]);
    }
}
