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

        Route::get("admin/dasboard" ,'index')
            ->name(Constants::Admin_DASHBOARD); //end dashoboard




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


    Route::controller(\App\Http\Controllers\backend\Admin\Vendor\VendorStatus::class)->group(function (){

        Route::get("/admin/vendor-status-active" , "index_active")
                ->name(Constants::Admin_Vendor_StatusActive_INDEX);

        Route::get("/admin/vendor-status-inactive" , "index_in_active")
                ->name(Constants::Admin_Vendor_StatusInActive_INDEX);

        Route::get("/admin/vendor-status/details/{id}" , "getDetails");


    });//end controller vendor status


});//end auth admin middleware
