<?php

namespace App\Repositories;

use App\Contracts\Backend\ProfileRepoInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorProfileRepo implements ProfileRepoInterface{
    // Define your class methods here

    public function UpdateProfile(Request $request){

        $user = $this->getUser();


        if($request->file("photo")){

            //if exists photo in folder vendor.photo delete it and make new one
            @unlink(public_path('upload/vendor.photo/'.$user->photo_profile));

            // to get extnsion of image example : png jpg
            $file_extension = $request->file("photo")->getClientOriginalExtension();
            //to rename image by data+extnsion
            $file_name = date('YmdHi').".".$file_extension;
            //to move file to public folder
            $request->file("photo")->move(public_path('upload/vendor.photo'),$file_name);

            // to put name of file in database
            $user->photo_profile = $file_name;
        }//end if file exists


            $user->name = $request->name;
            $user->username = $request->username;
            $user->phone_number = $request->phone_number;
            $user->street_address = $request->street_address;
            $user->city = $request->city;
            $user->postal_code = $request->postal_code;

            $user->save();
    }

    public function UpdatePassword(Request $request){
        $user = $this->getUser();

        DB::table('users')->where("id" , $user->id)->update([
            "password" => bcrypt($request->new_password)
        ]);

    }

    public function getUser(){
        return User::find(auth()->user()->id);
    }


}
