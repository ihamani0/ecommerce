<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;




//Auth User
Route::middleware("guest.user")->group(function (){

    Route::controller(AuthenticatedSessionController::class)->group(function (){

        Route::get("login" , "create")
            ->name("login");

        Route::post("login/store" , "store")
            ->name("login.store");
    });//end controller Authenticated Session Controller

    Route::controller(RegisteredUserController::class)->group(function (){
        Route::get("/register" , "create")
            ->name("register");
        Route::post("register/store" , "store")
            ->name("register.store");

    });//end controller Registered User Controller

});//end middleware Guest

Route::get('/dashboard', function () {
    return view('frontend.pages.dashboard');
})->middleware("auth.user");

Route::post("logout" , [AuthenticatedSessionController::class , "destroy"])
    ->middleware("auth.user")
        ->name("user.logout");








//breez route
require __DIR__.'/auth.php';
