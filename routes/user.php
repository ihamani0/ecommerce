<?php

use App\Constants\Constants;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Frontend\ProfileUserController;
use Illuminate\Support\Facades\Route;




//Auth User
Route::middleware("guest.user")->group(function (){

    Route::controller(AuthenticatedSessionController::class)->group(function (){

        Route::get("login" , "create")
            ->name(Constants::USER_LOGIN);

        Route::post("login/store" , "store")
            ->name(Constants::USER_LOGIN_STORE);
    });//end controller Authenticated Session Controller

    Route::controller(RegisteredUserController::class)->group(function (){
        Route::get("/register" , "create")
            ->name(Constants::USER_Register);
        Route::post("register/store" , "store")
            ->name(Constants::USER_Register_STORE);

    });//end controller Registered User Controller

});//end middleware Guest


//start middleware auth
Route::middleware("auth.user")->group(function (){

    //profile User Controller
    Route::controller(ProfileUserController::class)->group(function (){

        Route::get('/dashboard' , 'index')
                ->name(Constants::USER_ACCOUNT);

        Route::post('account/update' , 'update')
                ->name(Constants::USER_ACCOUNT_UPDATE);

        //Delete account

        Route::post('account/delete' , 'destroy')
                ->name(Constants::USER_ACCOUNT_DELETE);

    });//end Controller User


    Route::controller(\App\Http\Controllers\Frontend\WishListController::class)->group(function (){
        Route::get('/user-wish-list' , 'index')
                ->name(Constants::USER_WISH_LIST);


        Route::get('/user-wish-list-destroy/{id}' , 'destroy')
            ->name(Constants::USER_WISHLIST_DESTROY_PRODUCT);



        Route::get('/user-get-count-wish-list' , 'getCount');
    });



    /*USER_COMPARE_LIST*/

    Route::controller(\App\Http\Controllers\Frontend\CompareProductsController::class)->group(function (){
        Route::get('/user-compare-products' , 'index')
            ->name(Constants::USER_COMPARE_LIST);

        Route::get('/user-compare-list-destroy/{id}' , 'destroy')
            ->name(Constants::USER_COMPARE_DESTROY_PRODUCT);

        Route::get('/user-get-count-compare-list' , 'getCount');
    });





    Route::get("logout" , [AuthenticatedSessionController::class , "destroy"])
            ->name(Constants::USER_LOGOUT);





});//end middlware auth.user













//breez route
require __DIR__.'/auth.php';
