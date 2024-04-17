<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yoeunes\Toastr\Facades\Toastr;

class AdminProfileController extends Controller
{
        public function index(){
            $user = Auth::guard("admin")->user();

            return view("backend.admin.pages.profile",["user" => $user]);
        }

        public function store(Request $request){

            $AdminId = Auth::guard("admin")->user()->id;
            $Admin = Admin::find($AdminId);




            $cred = ["email" => $Admin->email , "password"=> $request->password];


            if( ! ( Auth::guard("admin")->attempt( $cred ) ) ){

                Toastr::error('Incorrect password','Password');
                return redirect()->back()->withErrors(["errorPassword" =>  'Incorrect password' ]);

            }


                if($request->file("photo")){

                    @unlink(public_path('upload/admin.photo/'.$Admin->photo_profile));

                    // to get extnsion of image example : png jpg
                    $file_extension = $request->file("photo")->getClientOriginalExtension();
                    //to rename image by data+extnsion
                    $file_name = date('YmdHi').".".$file_extension;
                    //to move file to public folder
                    $request->file("photo")->move(public_path('upload/admin.photo'),$file_name);

                    // to put name of file in database
                    $Admin->photo_profile = $file_name;
                }//end if file exists

                $Admin->name = $request->name;
                $Admin->email = $request->email;
                $Admin->phone_number = $request->phone_number;

                $Admin->save();

                Toastr::success('Profil Update Successfully','Succes');
                return redirect()->route("admin.profile");

        }


        public function Password_change_index(){
            return view("backend.admin.pages.ChangePassword");
        }

        public function Password_update(Request $request){
            //validtae
            $request->validate([
                "old_password" => "required",
                "new_password" => "required|confirmed",
            ]);

            //change password
            //if password dose not match the old one
            if ( ! Hash::check( $request->old_password, Auth::guard("admin")->user()->password ) ){
                    return back()->withErrors(["errorPassword"=> "The old password dosn't match"]);
            }

            $Admin = Admin::find(Auth::guard("admin")->user()->id);
            $Admin->update([
                "password" => Hash::make($request->new_password),
            ]);
            return back()->with(["success"=> "The Password Has been update Successfully"]);
        }
}
