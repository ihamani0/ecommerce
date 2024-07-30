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




Route::middleware(['auth.admin' , "IsActive.admin"])->group(function (){


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
        Route::post("admin/logout" ,'logout')
            ->name('admin.logout'); // logout
    });



    Route::controller(\App\Http\Controllers\backend\Admin\Dashboard\DashboardController::class)->group(function (){
        Route::prefix("admin" ,'logout')->group(function (){
            Route::get("dashboard" ,'index')
                ->name(Constants::Admin_DASHBOARD);


            //for notification admin
            Route::get("get-notification-for-admin/{idAdmin}" ,'getAdminNotification');
            Route::post("make-notification-as-read" ,'makeAdminNotificationAsRead');
        });
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


    //Product Controller
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


    //Coupon Controller

    Route::controller(\App\Http\Controllers\backend\Admin\Coupon\CouponsController::class)->group(function (){

        Route::prefix('admin')->group(function(){
            Route::get("/Coupon-List" , "index")
                ->name(Constants::Admin_Coupon_INDEX);

            Route::get("/Coupon-Add" , "create")
                ->name(Constants::Admin_Coupon_ADD);

            Route::post("/Coupon-Store" , "store")
                ->name(Constants::Admin_Coupon_STORE);

            Route::get("/Coupon-Edit/{uuid}" , "edit")
                ->name(Constants::Admin_Coupon_EDIT);

            Route::post("/Coupon-update" , "update")
                ->name(Constants::Admin_Coupon_UPDATE);

            Route::get("/Coupon-Destroy/{id}" , "destroy")
                ->name(Constants::Admin_Coupon_DESTORY);

            Route::get("/Coupon-status/{id}" , "status")
                ->name(Constants::Admin_Coupon_STATUS);

        }); // end prefix admin
    });//end Coupon Controller

    //Order Controller
    Route::controller(\App\Http\Controllers\backend\Admin\Order\OrderController::class)->group(function (){

        Route::prefix('admin')->group(function(){

                Route::get('/order-list' , 'index')
                    ->name(Constants::Admin_Order_INDEX);

                Route::get('/order-return-list' , 'return_index')
                    ->name(Constants::Admin_Order_Return_INDEX);

                Route::get('/order-view/{orderId}' , 'view')
                    ->name(Constants::Admin_Order_VIEW);

                Route::get('/order-change-status/{orderID}/{status}' , 'changeStatus')
                    ->name(Constants::Admin_Order_Change_Status);

        }); //end prefix


    }); // end Order controller


    //Slide Panel
    Route::controller(\App\Http\Controllers\backend\Admin\Slide\SlideController::class)->group(function (){
        Route::prefix("admin")->group(function(){
            Route::get("/Slide-List" , "index")
                ->name(Constants::Admin_Slide_INDEX);

            Route::get("/Slide-Add" , "create")
                ->name(Constants::Admin_Slide_ADD);

            Route::post("/Slide-Store" , "store")
                ->name(Constants::Admin_Slide_STORE);

            Route::get("/Slide-Edit/{uuid}" , "edit")
                ->name(Constants::Admin_Slide_EDIT);

            Route::post("/Slide-update" , "update")
                ->name(Constants::Admin_Slide_UPDATE);

            Route::get("/Slide-Destroy/{id}" , "destroy")
                ->name(Constants::Admin_Slide_DESTORY);
        }); //end prefix admin
    });//end slide Controller
    //banner Panel
    Route::controller(\App\Http\Controllers\backend\Admin\Banner\BannerController::class)->group(function (){
        Route::prefix("admin")->group(function(){
            Route::get("/Banner-List" , "index")
                ->name(Constants::Admin_Banner_INDEX);

            Route::get("/Banner-Add" , "create")
                ->name(Constants::Admin_Banner_ADD);

            Route::post("/Banner-Store" , "store")
                ->name(Constants::Admin_Banner_STORE);

            Route::get("/Banner-Edit/{uuid}" , "edit")
                ->name(Constants::Admin_Banner_EDIT);

            Route::post("/Banner-update" , "update")
                ->name(Constants::Admin_Banner_UPDATE);

            Route::get("/Banner-Destroy/{id}" , "destroy")
                ->name(Constants::Admin_Banner_DESTORY);
        }); //end prefix admin
    });//end BannerController

    //Report Controller
    Route::controller(\App\Http\Controllers\backend\Admin\Report\ReportController::class)->group(function(){
        Route::prefix("admin")->group(function(){

            Route::get('/report-search' , 'index')
                    ->name(Constants::Admin_Report_Index);

            Route::post('report-search-by-date' , 'searchByDate')
                    ->name(Constants::Admin_Report_SearchByDate);
            Route::post('report-search-by-week' , 'searchByWeek')
                ->name(Constants::Admin_Report_SearchByWeek);
            Route::post('report-search-by-month' , 'searchByMonth')
                ->name(Constants::Admin_Report_SearchByMonth);
            Route::post('report-search-by-year' , 'searchByYear')
                ->name(Constants::Admin_Report_SearchByYear);
        });//end prefix
    });//end Report Controller

    //user and vendors and admins management
    Route::controller(\App\Http\Controllers\backend\Admin\UsersManagementController::class)->group(function(){

        Route::prefix('admin')->group(function(){

            Route::get('users-management' , 'users_index')
                    ->name(Constants::Admin_Register_Users);
            Route::get('vendor-management' , 'vendor_index')
                ->name(Constants::Admin_Register_Vendor);
            //-------------For Admin Management---------------
            Route::get('admins-management' , 'admin_index')
                ->name(Constants::Admin_Register_Admin);
            Route::get('admins-add' , 'admin_add')
                ->name(Constants::Admin_Register_Admin_ADD);

            Route::post('admins-add' , 'admin_store')
                ->name(Constants::Admin_Register_Admin_Store);

            Route::get('admins-edit/{id}' , 'admin_edit')
                ->name(Constants::Admin_Register_Admin_Edit);

            Route::put('admins-edit' , 'admin_update')
                ->name(Constants::Admin_Register_Admin_Update);

            Route::put('admins-change-status' , 'changeStatusAdmin')
                ->name(Constants::Admin_Register_Admin_Change_Status);
            Route::delete('admins-destroy' , 'destroyAdmin')
                ->name(Constants::Admin_Register_Admin_Delete);


        }) ; // end prefix
    });// end controller

    //review system
    Route::controller(\App\Http\Controllers\backend\Admin\Review\ReviewController::class)->group(function(){

        Route::prefix('admin')->group(function(){
            Route::get('review-list' , 'index')
                ->name(Constants::Admin_Review_List);
            Route::get('comment-change-status/{id}' , 'changeStatus')
                ->name(Constants::Admin_Review_Approve);
        }) ; // end prefix
    });// end controller

    //Config system || i applied middleware role inside __const in this controller
    Route::controller(\App\Http\Controllers\backend\Admin\Setting\SettingController::class)->group(function(){

        Route::prefix('admin')->group(function(){
            Route::get('setting-page' , 'index')
                ->name(Constants::Admin_Setting_Index);
            Route::get('add-setting' , 'create')
                ->name(Constants::Admin_Setting_Add);
            Route::post('store-setting' , 'store')
                ->name(Constants::Admin_Setting_Store);
            Route::get('edite-setting' , 'edit')
                ->name(Constants::Admin_Setting_Edite);
            Route::post('edite-setting' , 'update')
                ->name(Constants::Admin_Setting_Update);
            Route::get('delete-setting' , 'delete')
                ->name(Constants::Admin_Setting_Delete);
        }) ; // end prefix
    });// end controller

    //Stock system
    Route::controller(\App\Http\Controllers\backend\Admin\Products\StockController::class)->group(function(){

        Route::prefix('admin')->group(function(){
            Route::get('stock-list' , 'index')
                ->name(Constants::Admin_Stock_Index);

            Route::post('stock-change' , 'changeStock')
                ->name(Constants::Admin_Stock_Change);
        }) ; // end prefix
    });// end controller


    //Permission Management || i applied middleware role inside __const in this controller
    Route::controller(\App\Http\Controllers\backend\Admin\Policy\PermissionsController::class)->group(function(){
        Route::prefix('admin')->group(function(){
            Route::get('permission-list' , 'index')
                ->name(Constants::Admin_Permission_Index);
            Route::get('permission-add' , 'add')
                ->name(Constants::Admin_Permission_Add);
            Route::post('permission-add' , 'store')
                ->name(Constants::Admin_Permission_Store);
            Route::get('permission-edit/{id}' , 'edit')
                ->name(Constants::Admin_Permission_Edit);
            Route::put('permission-edit' , 'update')
                ->name(Constants::Admin_Permission_Update);
            Route::delete('permission-destroy' , 'destroy')
                ->name(Constants::Admin_Permission_Destroy);

        });// end prefix
    });// end controller
    //Role Management || i applied middleware role inside __const in this controller
    Route::controller(\App\Http\Controllers\backend\Admin\Policy\RoleController::class)->group(function(){
        Route::prefix('admin')->group(function(){
            Route::get('role-list' , 'index')
                ->name(Constants::Admin_Role_Index);
            Route::get('role-add' , 'add')
                ->name(Constants::Admin_Role_Add);
            Route::post('role-add' , 'store')
                ->name(Constants::Admin_Role_Store);
            Route::get('role-edit/{id}' , 'edit')
                ->name(Constants::Admin_Role_Edit);
            Route::put('role-edit' , 'update')
                ->name(Constants::Admin_Role_Update);
            Route::delete('role-destroy' , 'destroy')
                ->name(Constants::Admin_Role_Destroy);

            Route::get('permission-to-role/{id}' , 'PermissionToRole')
                ->name(Constants::Admin_Permission_To_Role);
            Route::put('permission-to-role' , 'updatePermissionToRole')
                ->name(Constants::Admin_Update_Permission_To_Role);

        });// end prefix
    });// end controller




});//end auth admin middleware


