<?php

namespace App\Repositories;

use App\Contracts\Backend\ProfileRepoInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminProfileRepo implements ProfileRepoInterface {

    public function UpdateProfile(Request $request)
    {
        $admin = $this->getUser();

        if($request->file("photo")){

            @unlink(public_path('upload/admin.photo/'.$admin->photo_profile));

            // to get extension of image example : png jpg
            $file_extension = $request->file("photo")->getClientOriginalExtension();
            //to rename image by data+extension
            $file_name = date('YmdHi').".".$file_extension;
            //to move file to public folder
            $request->file("photo")->move(public_path('upload/admin.photo'),$file_name);

            // to put name of file in database
            $admin->photo_profile = $file_name;
        }//end if file exists

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone_number = $request->phone_number;

        $admin->save();
    }

    public function getUser(): \App\Models\Admin|\Illuminate\Contracts\Auth\Authenticatable|null
    {
        return Auth::guard('admin')->user();
    }

    public function UpdatePassword(Request $request)
    {
        $admin = $this->getUser();

        DB::table('users')->where("id" , $admin->id)->update([
            "password" => bcrypt($request->new_password)
        ]);
    }
}
