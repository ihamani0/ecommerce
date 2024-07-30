<?php

use App\Constants\Constants;
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

/*Route::get('/admin-notify' , function (){

        $admins  = Admin::whereHas('roles' , function ($query)  {
            $query->whereIn('name' , ['super-admin' , 'admin']);
        })->get();

         Notification::send($admins , new AdminNotification("New Order Has Been Charge"));
});*/

Route::controller(\App\Http\Controllers\Frontend\LandingPageController::class)->group(function(){

    Route::get('/', "index")
            ->name(Constants::WELCOME);
    Route::post('/', "search")
        ->name(Constants::WEB_SEARCH);

    Route::get('search-by-category' , "searchByCategory")
            ->name(Constants::WEB_SEARCH_BY_Category);
    Route::get('search-by-name-product' , "searchNameProduct")
        ->name(Constants::WEB_SEARCH_Name_Product);



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









