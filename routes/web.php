<?php

use App\Constants\Constants;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
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

    Route::post('/Add-To-Cart', "addToCart")
        ->name(Constants::ADD_TO_CART);

    Route::get('/Get-Cart', "getTheCart")
        ->name(Constants::GET_CART);

    Route::post('/Remove-From-Cart', "removeFromCart")
        ->name(Constants::REMOVE_FROM__CART);

});

    ///add-to-wish-list
     Route::controller(\App\Http\Controllers\Frontend\WishListController::class)->group(function(){

        Route::post("/add-to-wish-list" , 'store');

    });

     //add to compare two products

    Route::controller(\App\Http\Controllers\Frontend\CompareProductsController::class)->group(function(){

        Route::post("/add-to-compare-products" , 'store');

    });




    /*Route::get('/feature' , function (){
        dd(\App\Models\Product::active()->where("featured" , 1)->get());

    });*/




