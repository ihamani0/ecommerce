<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\UsersRegistersInterface;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersRegistersRepo implements UsersRegistersInterface {

    /*public function __construct(public  public ProfileServiceInterface $adminService)
    {}*/

    // Define your class methods here
    public function getAllVendors()
    {
        return User::where('role' , 'vendor')->get();
    }

    public function getAllUsers()
    {
        return User::where('role' , 'user')->get();
    }

    public function getAllAdmins()
    {
         return Admin::where('id', '!=' , auth()->guard('admin')->user()->id)->get();
    }

    public function storeAdmin(Request $request)
    {
        try {
            DB::beginTransaction();

                $admin = Admin::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
                $roleFromDB = Role::where('id', $request->role)->pluck('name')->toArray();
                $admin->assignRole($roleFromDB);

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }


    public function changeStatusAdmin(Request $request)
    {
        try {
            DB::beginTransaction();

            $admin = Admin::where('id' , $request->id)->first();
            $admin->status = !($admin->status);
            $admin->save();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }

    public function destroyAdmin(Request $request)
    {
        try {
            DB::beginTransaction();
            Admin::find($request->id)->delete();
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }

    public function getAllRoles(): \Illuminate\Database\Eloquent\Collection
    {
        return Role::all();
    }

    public function getAdmin($id)
    {
        return Admin::where('id' , $id)->first();
    }

    public function getRoleBelongToAdmin($id)
    {
        return $this->getAdmin($id)->roles->first();
    }

    public function updateAdmin(Request $request)
    {
        try {
            DB::beginTransaction();

            $admin = $this->getAdmin($request->id);
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $roleFromDB = Role::where('id', $request->role)->pluck('name')->toArray();
            $admin->syncRoles($roleFromDB);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }
}
