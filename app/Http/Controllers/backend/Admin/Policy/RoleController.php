<?php

namespace App\Http\Controllers\backend\Admin\Policy;

use App\Constants\Constants;
use App\Contracts\Backend\PolicyInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(public PolicyInterface $role)
    {}

    public function index(){
        return view('backend.admin.pages.Policy.role-index' , [
            "Roles" => $this->role->getAllRoles(),
        ]);
    }

    public function add(){
        return view('backend.admin.pages.Policy.role-add');
    }

    public function store(Request $request){

        try {
            $request->validate([
                'name' => ['required'],
            ]);
            $this->role->createRole($request);
            toastr()->addSuccess('The Role Added Successfully');
            return redirect()->route(Constants::Admin_Role_Index);
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage() ]);
        }

    }


    public function edit($id){
        return view('backend.admin.pages.Policy.role-edit' , [
            'role' => $this->role->getRole($id)
        ]);
    }



    public function update(Request $request){
        try {
            $request->validate([
                'name' => ['required'],
            ]);
            $this->role->updateRole($request);
            toastr()->addSuccess('The Role Updated Successfully');
            return redirect()->route(Constants::Admin_Role_Index);
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage() ]);
        }
    }


    public function destroy(Request $request){
        try {
            $request->validate([
                'id' => ['required'],
            ]);
            $this->role->deleteRole($request);
            toastr()->addSuccess('The Role Deleted Successfully');
            return redirect()->route(Constants::Admin_Role_Index);
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage() ]);
        }
    }



    public function PermissionToRole($id){
        return view('backend.admin.pages.Policy.add-permission-to-role' , [
            'role' => $this->role->getRole($id) ,
            'rolePermissions' => $this->role->getPermissionBelongsToRole($id),
            'permissionsGroup' => $this->role->getPermissions()
        ]);
    }

    public function updatePermissionToRole(Request $request){

        try {
            $request->validate([
                'id' => ['required'],
            ]);
            $this->role->AddPermissionsToRole($request);
            toastr()->addSuccess('Permissions Add To Role Successfully');
            return redirect()->route(Constants::Admin_Role_Index);
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage() ]);
        }
    }
}
