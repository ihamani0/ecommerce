<?php

namespace App\Http\Controllers\backend\Admin;

use App\Constants\Constants;
use App\Contracts\Backend\UsersRegistersInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersManagementController extends Controller
{
    public function __construct(public UsersRegistersInterface $user )
    {
        $this->middleware('role:super-admin,admin');
        $this->middleware('permission:view.register-users,admin')->only('users_index');
        $this->middleware('permission:view.register-vendors,admin')->only('vendor_index');
        $this->middleware('permission:view.register-admins,admin')->only('admin_index');
        $this->middleware('permission:view.register-admins,admin')->only('admin_add');
        $this->middleware('permission:view.register-admins,admin')->only('admin_edit');

    }

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
        return view('backend.admin.pages.RegisterUser.admins-add' , [
            "Roles" => $this->user->getAllRoles()
        ]);

    }
    public function admin_store(RegisterAdminRequest $request){

        try {
            $this->checkCredAdmin($request);

            $this->user->storeAdmin($request);
            return redirect()->route(Constants::Admin_Register_Admin)->with(['success' => "The admin Register Successfully"]);
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }


    public function admin_edit($id){
        return view('backend.admin.pages.RegisterUser.admins-edit' , [
            "Roles" => $this->user->getAllRoles(),
            "admin" => $this->user->getAdmin($id) ,
            "roleNameBelongToUser" =>  $this->user->getRoleBelongToAdmin($id)->name ,
            "roleIdBelongToUser" => $this->user->getRoleBelongToAdmin($id)->id ,
        ]);
    }

    public function admin_update(RegisterAdminRequest $request){
        try {

            $this->checkCredAdmin($request);

            $this->user->updateAdmin($request);
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

    public function destroyAdmin(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        try {
            $this->user->destroyAdmin($request);
            return redirect()->route(Constants::Admin_Register_Admin)->with(['success' => "The Admin Deleted Successfully"]);
        }catch (\Exception $exception){
            return redirect()->back()->with(['error' => $exception->getMessage()]);
        }
    }



    private function checkCredAdmin(Request $request){
            if(!Auth::guard("admin")
                ->attempt(["email" => Auth::guard("admin")->user()->email , "password"=> $request->password_super_admin]))
            {
                throw new \Exception("The Root password is Incorrect!");
            }
    }
}
