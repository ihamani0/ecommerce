<?php

namespace App\Contracts\Backend;

use Illuminate\Http\Request;

interface PolicyInterface{

    public function getAllPermissions();
    public function getPermission($id);
    public function createPermission(Request $request);
    public function updatePermission(Request $request);
    public function deletePermission(Request $request);

    public function getAllRoles();
    public function getRole($id);
    public function createRole(Request $request);
    public function updateRole(Request $request);
    public function deleteRole(Request $request);
    public function  getPermissionBelongsToRole($id);
    public function  AddPermissionsToRole(Request $request);
    public function getPermissions();
}
