<?php

namespace App\Http\Controllers\backend\Admin;

use App\Contracts\Backend\UsersRegistersInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersManagementController extends Controller
{
    public function __construct(public UsersRegistersInterface $user )
    {}

    public function users_index(){
        return view('backend.admin.pages.RegisterUser.users-register' ,
        [
            'Users' => $this->user->getAllUsers()
        ]);
    }
    public function vendor_index(){
        return view('backend.admin.pages.RegisterUser.vendors-register',
            [
                'Vendors' => $this->user->getAllVendors()
            ]);

    }
}
