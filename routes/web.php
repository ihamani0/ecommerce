<?php

use App\Constants\Constants;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Frontend\ProfileUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*404 page not found*/

Route::fallback([\App\Http\Controllers\Frontend\_404PageController::class , 'handle']);


Route::controller(\App\Http\Controllers\Frontend\LandingPageController::class)->group(function(){

    Route::get('/', "index")
            ->name(Constants::WELCOME);

    Route::get('/Product-details/{uuid}/{slug}', "productDetails")
                ->name(Constants::WEB_Products_Details);

    Route::get('/vendor-details/{id}', "VendorDetails")
            ->name(Constants::WEB_Vendor_Details);

    Route::get('/all-vendor', "AllVendors")
            ->name(Constants::WEB_All_Vendors);

    Route::get('/Products-by-Category/{uuid}/{slug}', "ProductsByCategory")
        ->name(Constants::WEB_Products_By_Category);

    Route::get('/Products-by-Subcategory/{uuid}/{slug}', "ProductsBySubcategory")
        ->name(Constants::WEB_Products_By_Subcategory);

});


Route::controller(\App\Http\Controllers\Frontend\CartShopController::class)->group(function(){

    Route::get('/index-Cart', "index")
        ->name(Constants::CART_INDEX);


    /*-----for ajax----------*/
    Route::prefix('api')->group(function (){

        Route::get('/Get-Cart', "getTheCart")
            ->name(Constants::GET_CART);

        Route::post('/Add-To-Cart', "addToCart")
            ->name(Constants::ADD_TO_CART);

        Route::post('/Remove-From-Cart', "removeFromCart")
            ->name(Constants::REMOVE_FROM_CART);

        Route::get('/Get-Cart-index', "getTheCart")
            ->name('api.get.cart.index');

        Route::post('/qty-decrement', "QtyDecrement")
            ->name('api.qty.decrement');

        Route::post('/qty-increment', "QtyIncrement")
            ->name('api.qty.increment');

        //coupons
        Route::post('/apply-coupon', "applyCoupon")
            ->name('api.apply.coupon');

        Route::get('/get-coupon-apply', "getCoupon")
            ->name('api.get.coupon.apply');

        Route::get('/remove-coupon-apply', "removeCoupon")
            ->name('api.remove.coupon.apply');

        Route::get('/Clear-Cart', "clearCart")
            ->name('api.clear.cart');

    });


    Route::middleware(['auth.user' , 'activity'])->group(function(){

        Route::get('/index-check-out-cart' , 'indexCheckOutCart')
            ->name(Constants::USER_INDEX_CHECKOUT_CART);

        Route::post('/store-check-out-cart' , 'storeCheckOutCart')
            ->name(Constants::USER_STORE_CHECKOUT_CART);

    });//end auth user middleware


});

    ///add-to-wish-list
     Route::controller(\App\Http\Controllers\Frontend\WishListController::class)->group(function(){

         Route::get('/user-wish-list' , 'index')
             ->name(Constants::USER_WISH_LIST);


         Route::get('/user-wish-list-destroy/{id}' , 'destroy')
             ->name(Constants::USER_WISHLIST_DESTROY_PRODUCT);



         Route::get('/user-get-count-wish-list' , 'getCount');

        Route::post("/add-to-wish-list" , 'store');

    })->middleware(['auth.user' , 'activity']);

     //add to compare two products

    Route::controller(\App\Http\Controllers\Frontend\CompareProductsController::class)->group(function(){

        Route::get('/user-compare-products' , 'index')
            ->name(Constants::USER_COMPARE_LIST);

        Route::get('/user-compare-list-destroy/{id}' , 'destroy')
            ->name(Constants::USER_COMPARE_DESTROY_PRODUCT);

        Route::get('/user-get-count-compare-list' , 'getCount');

        Route::post("/add-to-compare-products" , 'store');

    })->middleware(['auth.user' , 'activity']);



Route::get('order-pdf' , [ProfileUserController::class ,'CreateInvoice']);





