<?php

namespace App\Repositories;

use App\Contracts\Backend\ProfileRepoInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class VendorProfileRepo implements ProfileRepoInterface{
    // Define your class methods here

    public function UpdateProfile(Request $request){

        $user = $this->getUser();

        if ($request->hasFile('photo')) {
            if($user->photo_profile){
                Storage::delete($user->photo_profile);
            }
            $image = $request->file("photo");
            $new_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $extension = $image->getClientOriginalExtension();

            $path = 'public/upload/vendor/' . $new_name;


            if (strtolower($extension) == 'svg') {
                // Store the SVG file directly
                Storage::put($path, file_get_contents($image));
            } else {
                // Process and store other image files
                error_reporting(E_ERROR | E_PARSE);
                Image::make($image)->resize(120, 120)->save(storage_path('app/' . $path));
                error_reporting(E_ALL);
            }

            $user->photo_profile =  $path;
        }

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
