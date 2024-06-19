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

    //href="{{route(\App\Constants\Constants::WEB_Products_By_Category ,['uuid'=>$item->uuid_category , 'slug' => $item->category_slug])}}"

    //Route::get('/count', "countMax");
});







