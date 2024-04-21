<?php

namespace App\Http\Controllers\backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerifyEmailVendorController extends Controller
{
        private Otp $otp;

        public function __construct(){
            $this->otp = new Otp();
        }
        public function index(){
            return view("backend.vendor.pages.VerifyEmail");
        }
        public function verifyEmailVendor(Request $request){

            try {
                //validate otp required
            $request->validate([
                "otp" => "required"
            ]);
            //get email of authnticated user
            $email = Auth::user()->email;



            //call method validate to check email and otp from otp table in dataBase
            $validate = $this->otp->validate($email , $request->otp);




            if(! $validate->status) {

                return  back()->withErrors(["Error" => $validate->message]) ;
            }


            $affectedRows = DB::table('users')
                ->where('email', $email)
                    ->update(['email_verified_at' => now()]);

            if($affectedRows >  0){
                return  redirect()->route("vendor.dashboard");
            }

                return back()->withErrors(["Error"=> "Please try again !"]);


            } catch (\Exception $e) {
                    return back()->withErrors(["Error"=> $e->getMessage()]) ;
            }

        }
}
