<?php

use App\Constants\Constants;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\Auth\VendorAuthController;
use App\Http\Controllers\backend\Vendor\VendorController;
use App\Http\Controllers\backend\Auth\VerifyEmailVendorController;
use App\Http\Controllers\backend\Vendor\VendorProfileController;


/*---------------------------------------------------------------------------*/
/*---------------------- Vendor Auth Route -------------------------------------*/
/*---------------------------------------------------------------------------*/
Route::middleware('guest.vendor')->group(function (){


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

/*---------------------------------------------------------------------------*/
/*---------------------- Vendor Route -------------------------------------*/
/*---------------------------------------------------------------------------*/
Route::middleware(['auth' ,'verified' , 'activity' , "role.vendor:vendor"])->group(function (){

    //Logout
    Route::post("vendor/logout" ,[VendorAuthController::class,'logout'])
            ->middleware("VerifyEmail")
            ->name('vendor.logout'); // logout



    Route::controller(VendorController::class)->group(function (){

            Route::get("/vendor-dashboard" , "index" )
                    ->name(App\Constants\Constants::VENDOR_DASHBOARD);

        //for notification admin
        Route::get("vendor/get-notification-for-vendor/{idVendor}" ,'getVendorNotification');
        Route::post("vendor/make-notification-as-read-vendor" ,'makeVendorNotificationAsRead');

    });


    /*---------------------------------------------------------------------------*/
    /*---------------------- Profile Route -------------------------------------*/
    /*---------------------------------------------------------------------------*/
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


    Route::controller(\App\Http\Controllers\backend\Vendor\Products\ProductsController::class)->group(function (){
            Route::prefix("vendor")->group(function (){
                Route::get("/Products-List" , "index")
                    ->name(Constants::Vendor_Products_INDEX);

                Route::get("Products-Add" , "create")
                    ->name(Constants::Vendor_Products_ADD);

                Route::post("Products-Store" , "store")
                    ->name(Constants::Vendor_Products_STORE);

                Route::get("Products-Edit/{uuid}" , "edit")
                    ->name(Constants::Vendor_Products_EDIT);

                Route::post("Products-update" , "update")
                    ->name(Constants::Vendor_Products_UPDATE);

                Route::get("Products-Destroy/{id}" , "destroy")
                    ->name(Constants::Vendor_Products_DESTORY);

                //This rout for update Image in Products
                Route::post("Products-update-img" , "updateImg")
                    ->name(Constants::Vendor_Products_UPDATE_Img);
                //This rout for update Multiples Image in Products
                Route::post("Products-update-multi-img" , "updateMultiImg")
                    ->name(Constants::Vendor_Products_UPDATE_MultiImg);
                //This rout for update Image in Products
                Route::post("Products-add-multi-img" , "AddMultiImg")
                    ->name(Constants::Vendor_Products_Add_MultiImg);
                //This Route  for Destroy  Image  From multiple Images Table
                Route::get("Products-Destroy-Multi-Images/{id}/{idProduct}" , "destroyMultiImage")
                    ->name(Constants::Vendor_Products_DESTORY_MultiImg);

                //Status of products Route
                Route::get("/admin/Products-status/{id}" , "statusProduct")
                    ->name(Constants::Vendor_Products_Status);


            }); // end prefix
            Route::get("/api/vendor/subcategory/{id}" , "getSubCategories");
        });//end product controller


    //Order Controller
    Route::controller(\App\Http\Controllers\backend\Vendor\Order\OrderController::class)->group(function (){

        Route::prefix('vendor')->group(function(){

            Route::get('/order-list' , 'index')
                ->name(Constants::Vendor_ORDER_INDEX);

            Route::get('/order-view/{orderId}' , 'viewDetails')
                ->name(Constants::Vendor_ORDER_VIEW);

            Route::get('/order-return-list' , 'return')
                ->name(Constants::Vendor_ORDER_RETURN);

            Route::get('/order-change-status/{orderID}/{status}' , 'changeStatus')
                ->name(Constants::Vendor_Order_Change_Status);

        }); //end vendor prefix


    }); // end Order controller

    Route::controller(\App\Http\Controllers\backend\Vendor\Review\ReviewController::class)->group(function(){

        Route::prefix('vendor')->group(function(){
            Route::get('review-list' , 'index')
                ->name(Constants::Vendor_Review_List);
            Route::get('comment-change-status/{id}' , 'changeStatus')
                ->name(Constants::Vendor_Review_Approve);
        }) ; // end prefix
    });// end controller

});//end middleware auth and verified

