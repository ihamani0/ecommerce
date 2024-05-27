<?php

use App\Constants\Constants;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\Auth\VendorAuthController;
use App\Http\Controllers\backend\Vendor\VendorController;
use App\Http\Controllers\backend\Auth\VerifyEmailVendorController;
use App\Http\Controllers\backend\Vendor\VendorProfileController;

//in this middleware i give him role:vendor and path of his dashborad : vendor/dashboard
Route::middleware('guest')->group(function (){


        Route::controller(VendorAuthController::class)->group(function (){

            //login
            Route::get("/login-vendor" ,'showLogin')
                ->name(Constants::VENDOR_LOGIN);

            Route::post("/login-vendor/store" ,'Login')
                ->name(Constants::VENDOR_LOGIN_STORE);


            //register
            Route::get("/register-vendor" , 'showRegister')
                ->name(Constants::VENDOR_REGISTER);


            Route::post("/register-vendor/store" , "Register")
                ->name(Constants::VENDOR_REGISTER_STORE);




        });


});//end guest middleware


Route::middleware(['auth' ,'verified'])->group(function (){


    Route::post("vendor/logout" ,[VendorAuthController::class,'logout'])
            ->middleware("VerifyEmail")
            ->name('vendor.logout'); // logout


    Route::controller(VendorController::class)->group(function (){

            Route::get("/vendor/dashboard" , "index" )
                    ->name('vendor.dashboard');
        //App\Constants\Constants::VENDOR_DASHBOARD
    });

    //->Profile Route

    Route::controller(VendorProfileController::class)->group(function (){

            Route::get("/vendor/profile" , "index" )
                ->name(App\Constants\Constants::VENDOR_PROFILE_INDEX);

            Route::post("/vendor/profile/store" , 'store')
                ->name("vendor.profile.store");

            Route::get('admin/profile/change-password','Password_change_index')
            ->name('vendor.profile.ChangePassword.index');

            Route::post('admin/profile/change-password/update','Password_update')
                ->name("vendor.profile.update.password");
    });



});//end middleware auth and verified

