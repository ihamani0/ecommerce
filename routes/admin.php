<?php

use App\Http\Controllers\backend\Admin\AdminProfileController;
use App\Http\Controllers\backend\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest.admin')->group(function (){


    Route::controller(AdminAuthController::class)->group(function (){




        Route::get("admin/login" ,'showLogin')
            ->name('admin.login');

        Route::post("admin/store" ,'LoginStore')
            ->name('admin.loginStore');
    });


});//end guest middleware




Route::middleware('auth.admin')->group(function (){


    //controller admin Profile
    Route::controller(AdminProfileController::class)->group(function (){

        Route::get('admin/profile','index')
        ->name('admin.profile');

        Route::post('admin/profile/store','store')
        ->name('admin.profile.store');



        Route::get('admin/change-password','changePassword')
            ->name('admin.changePassword');

        Route::post('admin/change-password/update','updatePassword')
            ->name("admin.update.password");




    });


    //controller Admin

    Route::controller(AdminAuthController::class)->group(function (){

        Route::get("admin/dasboard" ,'index')
            ->name('admin.dashboard'); //end dashoboard




        Route::post("admin/logout" ,'logout')
            ->name('admin.logout'); // logout

    });



});//end auth admin middleware
