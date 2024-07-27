<?php

namespace App\Http\Controllers\backend\Admin;

use App\Constants\Constants;
use App\Contracts\Backend\UsersRegistersInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function admin_index(){
        return view('backend.admin.pages.RegisterUser.admins-register',
            [
                'Admins' => $this->user->getAllAdmins()
            ]);

    }

    public function admin_add(){
        return view('backend.admin.pages.RegisterUser.admins-add');

    }
    public function admin_store(Request $request){
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:admins',
                'password' => 'required|min:4|string|confirmed' ,
                'password_super_admin' => 'required',
            ]);
        try {
            if(!Auth::guard("admin")
                ->attempt(["email" => Auth::guard("admin")->user()->email , "password"=> $request->password_super_admin]))
            {
                throw new \Exception("The Root password is Incorrect!");
            }
            $this->user->storeAdmin($request);
            return redirect()->route(Constants::Admin_Register_Admin)->with(['success' => "The admin Register Successfully"]);
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }


    public function changeStatusAdmin(Request $request){
        $request->validate([
            'id' => 'required',
            ]);
        try {
            $this->user->changeStatusAdmin($request);
            return redirect()->route(Constants::Admin_Register_Admin)->with(['success' => "The Status Change Successfully"]);
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }
}
