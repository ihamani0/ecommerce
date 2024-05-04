<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\Auth\VendorAuthController;
use App\Http\Controllers\backend\Vendor\VendorController;
use App\Http\Controllers\backend\Auth\VerifyEmailVendorController;
use App\Http\Controllers\backend\Vendor\VendorProfileController;

//in this middleware i give him role:vendor and path of his dashborad : vendor/dashboard
Route::middleware('guest:vendor,vendor/dashboard')->group(function (){


        Route::controller(VendorAuthController::class)->group(function (){

            //login
            Route::get("/login-vendor" ,'showLogin')
                ->name('vendor.login');

            Route::post("/login-vendor/store" ,'Login')
                ->name('vendor.login.store');


            //register
            Route::get("/register-vendor" , 'showRegister')
                ->name("vendor.register");


            Route::post("/register-vendor/store" , "Register")
                ->name("vendor.register.store");




        });


});//end guest middleware


Route::middleware('auth')->group(function (){

    //Route note verify email

    Route::get('/register-vendor/verify' , [ VerifyEmailVendorController::class , "index"] )
        ->name("verification.notice");

    Route::post('/register-vendor/verify/confirm' , [ VerifyEmailVendorController::class , "verifyEmailVendor"] )
        ->name("verification.confirm");


    Route::post("vendor/logout" ,[VendorAuthController::class,'logout'])
            ->middleware("VerifyEmail")
            ->name('vendor.logout'); // logout


    /*
        Session of the vendor 
            ->Dashboard
            
    */     
    Route::controller(VendorController::class)->group(function (){

            Route::get("/vendor/dashboard" , "index" )
                    ->name('vendor.dashboard');
            
    });

            //->Profile Route

    Route::controller(VendorProfileController::class)->group(function (){
            
            Route::get("/vendor/profile" , "index" )
                ->name('vendor.profile');
            
            Route::post("/vendor/profile/store" , 'store')
                ->name("vendor.profile.store");

            Route::get('admin/profile/change-password','Password_change_index')
            ->name('vendor.profile.ChangePassword.index');
    
            Route::post('admin/profile/change-password/update','Password_update')
                ->name("vendor.profile.update.password");
    });   



});


