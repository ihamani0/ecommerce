<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\Auth\VendorAuthController;
use App\Http\Controllers\backend\Vendor\VendorController;
use App\Http\Controllers\backend\Auth\VerifyEmailVendorController;






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

    //controller Vendor
    Route::controller(VendorController::class)->group(function (){

        Route::get("/vendor/dashboard" , "index" )
                ->middleware("VerifyEmail")
                ->name('vendor.dashboard');

    });





});


