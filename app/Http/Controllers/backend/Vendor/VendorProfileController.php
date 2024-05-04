<?php

namespace App\Http\Controllers\backend\Vendor;


use App\Contracts\Backend\ProfileRepoInterface;
use App\Contracts\Backend\ProfileServiceInterface;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class VendorProfileController extends Controller
{

    /**
     *
     */
    public function __construct(public ProfileServiceInterface $vendorService , public ProfileRepoInterface $vendorRepo)
    {
    }


    public function index()
    {
        return view('backend.vendor.pages.profile', ["user" => Auth::user()]);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $user = $this->vendorRepo->getUser();

            $cred = ["email" => $user->email, "password" => $request->password];

            if (! $this->vendorService->attempt($cred) ) {

                toastr()->error('Oops! Something went wrong!', 'Oops!');
                return redirect()->back()->withErrors(["Error" =>  'Incorrect password']);
            }

            $this->vendorRepo->UpdateProfile($request);

            //commit database
            DB::commit();

            toastr()->success('Profile Update Successfully', 'Success');
            return redirect()->route("vendor.profile");
        } catch (Exception $e) {
            DB::rollBack();
            toastr()->error('Oops! Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors(["Error" =>  $e->getMessage()]);
        }
    } // end StoreProfile




    //password
    public function Password_change_index()
    {
        return view("backend.vendor.pages.ChangePassword");
    }

    public function Password_update(Request $request)
    {
        try {
            DB::beginTransaction();

            //validate
            $request->validate([
                "old_password" => "required",
                "new_password" => "required|confirmed",
            ]);

            $old_password = $request->old_password;

            //dd($this->vendorService->checkPassword($old_password));

            //change password
            //if password does not match the old one
            if (!$this->vendorService->checkPassword($old_password)) {
                //returned with error
                return back()->withErrors(["error" => "The old password doesn't match"]);
            }


            $this->vendorRepo->UpdatePassword($request);

            //commit database
            DB::commit();

            return redirect()->back()->with(['success' => "password has been updated!"]);
        } catch (Exception $e) {
            DB::rollBack();
            toastr()->error('Oops! Something went wrong!', 'Oops!');
            return redirect()->back()->withErrors(["Error" =>  $e->getMessage()]);
        }
    }
}
