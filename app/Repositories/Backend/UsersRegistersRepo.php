<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\UsersRegistersInterface;
use App\Models\User;

class UsersRegistersRepo implements UsersRegistersInterface {
    // Define your class methods here
    public function getAllVendors()
    {
        return User::where('role' , 'vendor')->get();
    }

    public function getAllUsers()
    {
        return User::where('role' , 'user')->get();
    }
}
