<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest.admin')->group(function (){


    Route::controller(AdminController::class)->group(function (){




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

        Route::get('admin/profile/change-password','Password_change_index')
        ->name('admin.profile.ChangePassword.index');

        Route::post('admin/profile/change-password/update','Password_update')
            ->name("admin.profile.update.password");


    });


    //controller Admin

    Route::controller(AdminController::class)->group(function (){

        Route::get("admin/dasboard" ,'index')
            ->name('admin.dashboard'); //end dashoboard




        Route::post("admin/logout" ,'logout')
            ->name('admin.logout'); // logout

    });



});//end auth admin middleware
