<?php

namespace App\Http\Controllers\backend\Admin\Policy;

use App\Constants\Constants;
use App\Contracts\Backend\PolicyInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{

    public function __construct(public PolicyInterface $permission)
    {}

    public function index(){
         return view('backend.admin.pages.Policy.permissions-index' , [
             "Permissions" => $this->permission->getAllPermissions(),
             ]);
     }

    public function add(){
        return view('backend.admin.pages.Policy.permissions-add');
    }

    public function store(Request $request){

            $request->validate([
                'name' => ['required'],
                'group' => ['required']
            ]);
        try {
            $this->permission->createPermission($request);
            toastr()->addSuccess('The Permission Added Successfully');
            return redirect()->route(Constants::Admin_Permission_Index);
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage() ]);
        }

    }


    public function edit($id){
        return view('backend.admin.pages.Policy.permissions-edit' , [
            'permission' => $this->permission->getPermission($id)
        ]);
    }



    public function update(Request $request){
            $request->validate([
                'name' => ['required'],
                'group' => ['required']
            ]);
        try {
            $this->permission->updatePermission($request);
            toastr()->addSuccess('The Permission Updated Successfully');
            return redirect()->route(Constants::Admin_Permission_Index);
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage() ]);
        }
    }


    public function destroy(Request $request){
        $request->validate([
            'id' => ['required'],
        ]);
        try {

            $this->permission->deletePermission($request);
            toastr()->addSuccess('The Permission Deleted Successfully');
            return redirect()->route(Constants::Admin_Permission_Index);
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage() ]);
        }
    }

}
