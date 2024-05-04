<?php

namespace App\Http\Controllers\backend\Admin;

use App\Contracts\Backend\ProfileRepoInterface;
use App\Contracts\Backend\ProfileServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yoeunes\Toastr\Facades\Toastr;

class AdminProfileController extends Controller
{
        public function __construct(
            public ProfileRepoInterface $adminRepo,
            public ProfileServiceInterface $adminService
        )
        {}

        public function index(){
            return view("backend.admin.pages.profile",["user" => $this->adminRepo->getUser()]);
        }

        public function store(Request $request){

            try {
                DB::beginTransaction();
                    $admin = $this->adminRepo->getUser();
                    $cred = ["email" => $admin->email , "password"=> $request->password];


                    if( ! ( $this->adminService->attempt($cred) ) ){
                        return redirect()->back()->with(
                            ["errorPassword" =>  'Incorrect password' , "error" =>  'Incorrect password ,Please Try again']
                        );
                    }

                    $this->adminRepo->UpdateProfile($request);
                DB::commit();


                    return redirect()->route("admin.profile")->with(['success' => "Profile has been updated!"]);
            }catch (\Exception $e){
                DB::rollBack();
                    return redirect()->back()->withErrors(["error" =>  $e->getMessage()]);
            }

        }


        public function changePassword(){
            return view("backend.admin.pages.ChangePassword");
        }

        public function updatePassword(Request $request){
                //start method
            try{

                //validtae
                $request->validate([
                    "old_password" => "required",
                    "new_password" => "required|confirmed",
                ]);

                $old_password = $request->old_password;

                //change password
                //if password dose not match the old one
                if ( !  $this->adminService->checkPassword($old_password)  ){
                    return back()->with(["error"=> "The old password doesn't match"]);
                }

                $this->adminRepo->UpdatePassword($request);

                //commit database
                DB::commit();

                    return back()->with(["success"=> "The Password Has been update Successfully"]);
            }catch (\Exception $e){
                DB::rollBack();
                    toastr()->error('Oops! Something went wrong!', 'Oops!');
                    return redirect()->back()->with(["error" =>  $e->getMessage()]);
            }


        }//end method
}
