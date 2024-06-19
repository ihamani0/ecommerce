<?php

namespace App\Repositories;

use App\Contracts\Backend\ProfileRepoInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class AdminProfileRepo implements ProfileRepoInterface {

    public function UpdateProfile(Request $request)
    {
        $admin = $this->getUser();

        if ($request->hasFile('photo')) {
            if($admin->photo_profile){
                Storage::delete($admin->photo_profile);
            }
            $image = $request->file("photo");
            $new_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $extension = $image->getClientOriginalExtension();

            $path = 'public/upload/admin/' . $new_name;


            if (strtolower($extension) == 'svg') {
                // Store the SVG file directly
                Storage::put($path, file_get_contents($image));
            } else {
                // Process and store other image files
                error_reporting(E_ERROR | E_PARSE);
                Image::make($image)->resize(120, 120)->save(storage_path('app/' . $path));
                error_reporting(E_ALL);
            }

            $admin->photo_profile =  $path;
        }

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
