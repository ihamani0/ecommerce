<?php

use App\Constants\Constants;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Frontend\ProfileUserController;
use App\Http\Controllers\Frontend\StripePaymentController;
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




    Route::get("logout" , [AuthenticatedSessionController::class , "destroy"])
            ->name(Constants::USER_LOGOUT);



    //payment
    Route::prefix('payment')->group(function(){
        //Stripe Payment Controller
        Route::controller(StripePaymentController::class)->group(function(){

                Route::get('/success' , function(){
                    return redirect()->route(App\Constants\Constants::USER_ACCOUNT)
                        ->with(['success' => "The Order Place Successfully"]);
                });

                Route::get('/failed' , function(){
                    return redirect()->route(App\Constants\Constants::USER_ACCOUNT)
                        ->with(['error' => "There is Error please Try Again "]);
                });
        });

        Route::controller(\App\Http\Controllers\Frontend\CashOnDeliveryController::class)->group(function(){

            Route::get('/cashOnDelivery-payment' , 'index')
                ->name(Constants::CASH_PAYMENT_INDEX);

            Route::post('/cashOnDelivery-payment' , 'store')
                ->name(Constants::CASH_PAYMENT_STORE);

        }); // end CashOnDelivery payment


    }); //end prefix Payment




});//end middlware auth.user













//breez route
require __DIR__.'/auth.php';
