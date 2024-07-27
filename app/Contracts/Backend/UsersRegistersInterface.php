<?php

namespace App\Contracts\Backend;

use Illuminate\Http\Request;

interface UsersRegistersInterface{
    // Define your interface methods here

    public function getAllVendors();
    public function getAllUsers();

    public function getAllRoles();
    public function getAllAdmins();
    public function storeAdmin(Request $request);
    public function changeStatusAdmin(Request $request);
    public function destroyAdmin(Request $request);
}
