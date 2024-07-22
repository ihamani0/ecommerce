<?php

use App\Constants\Constants;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Frontend\ProfileUserController;
use App\Http\Controllers\Frontend\StripePaymentController;
use App\Repositories\Frontend\LandingPageRepo;
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
Route::middleware(["auth.user" , 'activity'])->group(function (){

    Route::get("logout" , [AuthenticatedSessionController::class , "destroy"])
        ->name(Constants::USER_LOGOUT);
    //profile User Controller
    Route::prefix('customer')->group(function (){
        Route::controller(ProfileUserController::class)->group(function (){

            Route::get('/account-customer' , 'index')
                ->name(Constants::USER_ACCOUNT);

            Route::get('/dashboard' , 'dashboard_index')
                ->name(Constants::USER_ACCOUNT_DASHBOARD);

            Route::get('/orders-list' , 'orders_index')
                ->name(Constants::USER_ACCOUNT_Orders);

            //Return order Route

            Route::get('/orders-return-list' , 'orders_return_index')
                ->name(Constants::USER_ACCOUNT_INDEX_Return_Orders);


            Route::post('/order-return' , 'orders_return')
                ->name(Constants::USER_ACCOUNT_Orders_Return);


            Route::get('/track-orders' , 'track_orders_index')
                ->name(Constants::USER_ACCOUNT_Track_Orders);

            Route::get('/address-details' , 'address_index')
                ->name(Constants::USER_ACCOUNT_ADDRESS_DETAILS);

            Route::get('/change-password' , 'change_password_index')
                ->name(Constants::USER_ACCOUNT_CHANGE_PASSWORD);

            //Update Account Details
            Route::get('account-update' , 'account_detail_index')
                ->name(Constants::USER_ACCOUNT_UPDATE_INDEX);

            Route::post('account-update' , 'update')
                ->name(Constants::USER_ACCOUNT_UPDATE);

            Route::get('account-delete' , 'delete_account_index')
                ->name(Constants::USER_ACCOUNT_DELETE_INDEX);
            //Delete account
            Route::post('account-delete' , 'destroy')
                ->name(Constants::USER_ACCOUNT_DELETE);


            Route::get('download-invoice/{orderID}' , 'CreateInvoice')
                ->name(Constants::DOWNLOAD_INVOICE);

                //----------------Ajax------------------------
                    Route::prefix('api')->group(function(){
                        Route::post('get-order-details' , 'getOrderDetails')
                                ->name('api.get.order.details');
                    }); // end prefix api

        });//end Controller User
    }); // end prefix customer

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


    Route::controller(\App\Http\Controllers\Frontend\ReviewController::class)->group(function (){
        Route::post('/comment-store' , 'store')
                ->name('store.comment');
    });


    Route::controller(\App\Http\Controllers\Frontend\WishListController::class)->group(function(){

        Route::get('/user-wish-list' , 'index')
            ->name(Constants::USER_WISH_LIST);


        Route::get('/user-wish-list-destroy/{id}' , 'destroy')
            ->name(Constants::USER_WISHLIST_DESTROY_PRODUCT);



        Route::get('/user-get-count-wish-list' , 'getCount');

        Route::post("/add-to-wish-list" , 'store');

    });


    //add to compare two products
    Route::controller(\App\Http\Controllers\Frontend\CompareProductsController::class)->group(function(){

        Route::get('/user-compare-products' , 'index')
            ->name(Constants::USER_COMPARE_LIST);

        Route::get('/user-compare-list-destroy/{id}' , 'destroy')
            ->name(Constants::USER_COMPARE_DESTROY_PRODUCT);

        Route::get('/user-get-count-compare-list' , 'getCount');

        Route::post("/add-to-compare-products" , 'store');

    });


});//end middlware auth.user













//breez route
require __DIR__.'/auth.php';
