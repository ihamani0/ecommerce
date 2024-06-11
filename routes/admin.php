<?php

use App\Constants\Constants;
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

        Route::get("admin/dashboard" ,'index')
            ->name(Constants::Admin_DASHBOARD); //end dashboard

        Route::post("admin/logout" ,'logout')
            ->name('admin.logout'); // logout

    });


    //Brand Route

    Route::controller(\App\Http\Controllers\backend\Admin\Brand\BrandController::class)->group(function (){
            Route::get("/admin/brand-List" , "index")
                ->name(Constants::Admin_BRAND_INDEX);

            Route::get("/admin/brand-Add" , "create")
                ->name(Constants::Admin_BRAND_ADD);

            Route::post("/admin/brand-Store" , "store")
            ->name(Constants::Admin_BRAND_STORE);

            Route::get("/admin/brand-Edit/{uuid}" , "edit")
                ->name(Constants::Admin_BRAND_EDIT);

            Route::put("/admin/brand-Update" , "update")
            ->name(Constants::Admin_BRAND_UPDATE);

            Route::get("/admin/brand-Destroy/{id}" , "destroy")
                ->name(Constants::Admin_BRAND_DESTORY);
    });//end Controller Brand



    //Category Route

    Route::controller(\App\Http\Controllers\backend\Admin\Category\CategoryController::class)->group(function (){
        Route::get("/admin/category-List" , "index")
            ->name(Constants::Admin_Category_INDEX);

        Route::get("/admin/category-Add" , "create")
            ->name(Constants::Admin_Category_ADD);

        Route::post("/admin/category-Store" , "store")
            ->name(Constants::Admin_Category_STORE);

        Route::get("/admin/category-Edit/{uuid}" , "edit")
            ->name(Constants::Admin_Category_EDIT);

        Route::post("/admin/Category-update" , "update")
            ->name(Constants::Admin_Category_UPDATE);

        Route::get("/admin/category-Destroy/{id}" , "destroy")
            ->name(Constants::Admin_Category_DESTORY);


    });//end Controller Category


    //Category Route

    Route::controller(\App\Http\Controllers\backend\Admin\Category\SubcategoryController::class)->group(function (){
        Route::get("/admin/Subcategory-List" , "index")
            ->name(Constants::Admin_SubCategory_INDEX);

        Route::get("/admin/Subcategory-Add" , "create")
            ->name(Constants::Admin_SubCategory_ADD);

        Route::post("/admin/Subcategory-Store" , "store")
            ->name(Constants::Admin_SubCategory_STORE);

        Route::get("/admin/Subcategory-Edit/{uuid}" , "edit")
            ->name(Constants::Admin_SubCategory_EDIT);

        Route::post("/admin/Subcategory-update" , "update")
            ->name(Constants::Admin_SubCategory_UPDATE);

        Route::get("/admin/Subcategory-Destroy/{id}" , "destroy")
            ->name(Constants::Admin_SubCategory_DESTORY);


    });//end Controller Category

    //Vendors Status Route
    Route::controller(\App\Http\Controllers\backend\Admin\Vendor\VendorStatus::class)->group(function (){

        Route::get("/admin/vendor-status-active" , "index_active")
                ->name(Constants::Admin_Vendor_StatusActive_INDEX);

        Route::get("/admin/vendor-status-inactive" , "index_in_active")
                ->name(Constants::Admin_Vendor_StatusInActive_INDEX);

        Route::get("/admin/vendor-status/active/{id}" , "active")
            ->name(Constants::Admin_Active_Vendor);

        Route::get("/admin/vendor-status/inactive/{id}" , "inactive")
            ->name(Constants::Admin_InActive_Vendor);

        //api endpoint using to fetch Vendor Details from DB
        Route::get("/admin/vendor-status/details/{id}" , "getDetails");


    });//end controller vendor status


    Route::controller(\App\Http\Controllers\backend\Admin\Products\ProductsController::class)->group(function (){
            Route::get("/admin/Products-List" , "index")
                ->name(Constants::Admin_Products_INDEX);

            Route::get("/admin/Products-Add" , "create")
                ->name(Constants::Admin_Products_ADD);

            Route::post("/admin/Products-Store" , "store")
                ->name(Constants::Admin_Products_STORE);

            Route::get("/admin/Products-Edit/{uuid}" , "edit")
                ->name(Constants::Admin_Products_EDIT);

            Route::post("/admin/Products-update" , "update")
                ->name(Constants::Admin_Products_UPDATE);

            Route::get("/admin/Products-Destroy/{id}" , "destroy")
                ->name(Constants::Admin_Products_DESTORY);

            //This rout for update Image in Products
            Route::post("/admin/Products-update-img" , "updateImg")
                ->name(Constants::Admin_Products_UPDATE_Img);
            //This rout for update Multiples Image in Products
            Route::post("/admin/Products-update-multi-img" , "updateMultiImg")
                        ->name(Constants::Admin_Products_UPDATE_MultiImg);
            //This rout for update Image in Products
            Route::post("/admin/Products-add-multi-img" , "AddMultiImg")
                ->name(Constants::Admin_Products_Add_MultiImg);
            //This Route  for Destroy  Image  From multiple Images Table
            Route::get("/admin/Products-Destroy-Multi-Images/{id}/{idProduct}" , "destroyMultiImage")
                ->name(Constants::Admin_Products_DESTORY_MultiImg);

            //Status of products Route
            Route::get("/admin/Products-status/{id}" , "statusProduct")
                        ->name(Constants::Admin_Products_Status);

            Route::get("/api/admin/subcategory/{id}" , "getSubCategories");
    });//end products  controller



    //Slide Panel
    Route::controller(\App\Http\Controllers\backend\Admin\Slide\SlideController::class)->group(function (){

    });//end slide Controller
    //banner Panel
    Route::controller(\App\Http\Controllers\backend\Admin\Banner\BannerController::class)->group(function (){});//end BannerController
});//end auth admin middleware

