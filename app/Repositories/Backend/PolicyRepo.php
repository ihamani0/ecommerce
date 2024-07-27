<?php

namespace App\Repositories\Backend;

use App\Constants\Constants;
use App\Contracts\Backend\PolicyInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PolicyRepo implements PolicyInterface {



    public function getAllPermissions(): \Illuminate\Database\Eloquent\Collection
    {
        //dd(Permission::where('guard_name', 'admin')->get()->groupBy('group'));
        return Permission::where('guard_name', 'admin')->get();
    }

    public function getPermissions(): \Illuminate\Database\Eloquent\Collection
    {
        //dd(Permission::where('guard_name', 'admin')->get()->groupBy('group'));
        return Permission::where('guard_name', 'admin')->get()->groupBy('group');
    }

    public function createPermission(Request $request)
    {
        try {
            DB::beginTransaction();
            Permission::create(
                [
                    'name' => $request->name ,
                    'group' => $request->group,
                    'guard_name' => 'admin'
                ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }

    public function updatePermission(Request $request)
    {
        try {
            DB::beginTransaction();
            Permission::where('id' , $request->id)->update(
                [
                    'name' => $request->name ,
                    'group' => $request->group,
                ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }

    public function deletePermission(Request $request)
    {
        Permission::find($request->id)->delete();
    }

    public function getPermission($id)
    {
         return Permission::find($id);
    }


    /*-------------------------------------------*/
    /*-------------------------------------------*/
    public function getAllRoles(): \Illuminate\Database\Eloquent\Collection
    {
        return Role::all();
    }

    public function getRole($id)
    {
        return Role::find($id);
    }

    public function createRole(Request $request)
    {
        try {
            DB::beginTransaction();
            Role::create(
                [
                    'name' => $request->name ,
                    'guard_name' => 'admin'
                ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }

    public function updateRole(Request $request)
    {
        try {
            DB::beginTransaction();

            Role::where('id' , $request->id)->update(
                [
                    'name' => $request->name ,
                ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }

    public function deleteRole(Request $request)
    {
        Role::find($request->id)->delete();
    }

    public function getPermissionBelongsToRole($id)
    {
        $role = Role::where('guard_name', 'admin')->where('id' , $id)->first();
        return  $role->permissions()->where('guard_name', 'admin')->pluck('id')->toArray();
    }

    public function AddPermissionsToRole(Request $request)
    {
        try {
            DB::beginTransaction();
            $role = Role::where('guard_name', 'admin')->where('id' , $request->id)->first();
            if (empty($request->permissions)) {

                $role->syncPermissions([]);
            }else{

                $Permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
                $role->syncPermissions($Permissions);
            }

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }
    }
}
