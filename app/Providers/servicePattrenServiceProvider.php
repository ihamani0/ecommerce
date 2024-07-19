<?php

namespace App\Providers;

use App\Contracts\Backend\CouponInterface;
use App\Contracts\Backend\CrudInterface;
use App\Contracts\Backend\ProductInterface;
use App\Contracts\Backend\ProfileRepoInterface;
use App\Contracts\Backend\ProfileServiceInterface;
use App\Contracts\Backend\UsersRegistersInterface;
use App\Contracts\Backend\VendorInterface;

use App\Contracts\Frontend\LandingPageInterface;
use App\Contracts\Frontend\OrderInterface;
use  App\Http\Controllers\backend\Admin\AdminProfileController;
use App\Http\Controllers\backend\Admin\Banner\BannerController;
use App\Http\Controllers\backend\Admin\Brand\BrandController;
use App\Http\Controllers\backend\Admin\Category\CategoryController;
use App\Http\Controllers\backend\Admin\Category\SubcategoryController;
/*use App\Http\Controllers\backend\Admin\Products\ProductsController;*/

use App\Http\Controllers\backend\Admin\Coupon\CouponsController;

use App\Http\Controllers\backend\Admin\Order\OrderController;
use App\Http\Controllers\backend\Admin\Order\OrderController as OrderControllerAdmin;
use App\Http\Controllers\backend\Admin\UsersManagementController;
use App\Http\Controllers\backend\Vendor\Order\OrderController as OrderControllerVendor;

use App\Http\Controllers\backend\Admin\Products\ProductsController as adminProductsController;
use App\Http\Controllers\backend\Admin\Slide\SlideController;
use App\Http\Controllers\backend\Vendor\Products\ProductsController as vendorProductsController;

use App\Http\Controllers\backend\Admin\Vendor\VendorStatus;
use App\Http\Controllers\backend\Vendor\VendorProfileController;
use App\Http\Controllers\Frontend\_404PageController;
use App\Http\Controllers\Frontend\CartShopController;
use App\Http\Controllers\Frontend\CashOnDeliveryController;
use App\Http\Controllers\Frontend\CompareProductsController;
use App\Http\Controllers\Frontend\LandingPageController;
use App\Http\Controllers\Frontend\ProfileUserController;
use App\Http\Controllers\Frontend\StripePaymentController;
use App\Http\Controllers\Frontend\WishListController;
use App\Repositories\AdminProfileRepo;

use App\Repositories\Backend\BannerRepo;
use App\Repositories\Backend\BrandRepo;
use App\Repositories\Backend\CategoryRepo;
use App\Repositories\Backend\CouponRepo;
use App\Repositories\Backend\ProductRepo;
use App\Repositories\Backend\SlideRepo;
use App\Repositories\Backend\SubcategoryRepo;
use App\Repositories\Backend\UsersRegistersRepo;
use App\Repositories\Backend\VendorRepo;
use App\Repositories\Frontend\LandingPageRepo;
use App\Repositories\Frontend\OrderRepo;
use App\Repositories\VendorProfileRepo;
use App\Services\Backend\AdminProfileService;
use App\Services\Backend\VendorProfileService;


use App\Services\Frontend\OrderService;
use Illuminate\Support\ServiceProvider;

class servicePattrenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        //-------------------- Payment--------------------
        //---------------------------for Cash on delivery ---- for Stripe-----------------------------------------------------
        $this->app->bind(OrderService::class, function ($app) {
            return new OrderService($app->make(OrderRepo::class));
                });

        //--------------------------------------------------------------------------------
        $this->app->when(CashOnDeliveryController::class)
                        ->needs(LandingPageInterface::class)
                                ->give(LandingPageRepo::class);
        //--------------------------------------------------------------------------------
        ////--------------------------------------------------------------------------------
        //--------------------for Cart Products --------------------
        $this->app->when(CartShopController::class)
                        ->needs(LandingPageInterface::class)
                            ->give(LandingPageRepo::class);
        //--------------------------------------------------------------------------------
        //--------------------for Compare Products --------------------
        $this->app->when(CompareProductsController::class)
            ->needs(LandingPageInterface::class)
            ->give(LandingPageRepo::class);
        //--------------------------------------------------------------------------------
        //--------------------for landing Page--------------------
        $this->app->when(LandingPageController::class)
                    ->needs(LandingPageInterface::class)
                            ->give(LandingPageRepo::class);
        //--------------------for  ProfileUser Controller--------------------
        //--------------------------------------------------------------------------------
        $this->app->when(ProfileUserController::class)
                    ->needs(LandingPageInterface::class)
                            ->give(LandingPageRepo::class);
        //--------------------------------------------------------------------------------
        //--------------------for  WishListController --------------------
        //--------------------------------------------------------------------------------
        $this->app->when(WishListController::class)
                    ->needs(LandingPageInterface::class)
                        ->give(LandingPageRepo::class);

        $this->app->when(_404PageController::class)
                            ->needs(LandingPageInterface::class)
                                ->give(LandingPageRepo::class);

        //-------------------Order for dashboard User
        $this->app->when(ProfileUserController::class)
            ->needs(\App\Contracts\Backend\OrderInterface::class)
            ->give(\App\Repositories\Backend\OrderRepo::class);

        //------------------------------------------------------BACK END--------------------------------------------------------------------------------------

        //--------------------for All Users and Vendors Register--------------------
        $this->app->when(UsersManagementController::class)
                    ->needs(UsersRegistersInterface::class)
                            ->give(UsersRegistersRepo::class);

        //--------------------for Order--------------------
        $this->app->when(\App\Http\Controllers\backend\Admin\Order\OrderController::class)
                    ->needs(\App\Contracts\Backend\OrderInterface::class)
                            ->give(\App\Repositories\Backend\OrderRepo::class);

        //--------------------for Order Admin--------------------
        $this->app->when(\App\Http\Controllers\backend\Vendor\Order\OrderController::class)
                    ->needs(\App\Contracts\Backend\OrderInterface::class)
                            ->give(\App\Repositories\Backend\OrderRepo::class);
        //--------------------for Coupon--------------------
        $this->app->when(CouponsController::class)
                        ->needs(CouponInterface::class)
                                ->give(CouponRepo::class);
        //--------------------------------------------------------------------------------
        //--------------------for Slide--------------------
        $this->app->when(SlideController::class)
                    ->needs(CrudInterface::class)
                        ->give(SlideRepo::class);
        //--------------------------------------------------------------------------------
        //--------------------for  Banner--------------------
        $this->app->when(BannerController::class)
                    ->needs(CrudInterface::class)
                        ->give(BannerRepo::class);
        //--------------------------------------------------------------------------------
        //--------------------for Product--------------------
        $this->app->when(adminProductsController::class)
                        ->needs(ProductInterface::class)
                            ->give(ProductRepo::class);
        $this->app->when(vendorProductsController::class)
                        ->needs(ProductInterface::class)
                            ->give(ProductRepo::class);
        //--------------------------------------------------------------------------------
        //--------------------for VendorsStatus--------------------
        $this->app->when(VendorStatus::class)
                        ->needs(VendorInterface::class)
                            ->give(VendorRepo::class);
        //--------------------------------------------------------------------------------
        //--------------------for SubCategory--------------------
        $this->app->when(SubcategoryController::class)
                    ->needs(CrudInterface::class)
                        ->give(SubcategoryRepo::class);
        //--------------------------------------------------------------------------------
        //--------------------for Category--------------------
        $this->app->when(CategoryController::class)
                    ->needs(CrudInterface::class)
                        ->give(CategoryRepo::class);

        //--------------------------------------------------------------------------------
        //--------------------for Brand--------------------
        $this->app->when(BrandController::class)
                    ->needs(CrudInterface::class)
                        ->give(BrandRepo::class);


        //--------------------------------------------------------------------------------
        //--------------------for vendor--------------------
                $this->app->when(VendorProfileController::class)
                        ->needs(ProfileRepoInterface::class)
                            ->give(VendorProfileRepo::class);

                $this->app->when(VendorProfileController::class)
                        ->needs(ProfileServiceInterface::class)
                            ->give(VendorProfileService::class);

                $this->app->when(VendorProfileService::class)
                        ->needs(ProfileRepoInterface::class)
                            ->give(VendorProfileRepo::class);
        //------------------------------------------------------------
        //---------------------for admin--------------------
                $this->app->when(AdminProfileController::class)
                        ->needs(ProfileRepoInterface::class)
                            ->give(AdminProfileRepo::class);

                $this->app->when(AdminProfileController::class)
                        ->needs(ProfileServiceInterface::class)
                            ->give(AdminProfileService::class);

                $this->app->when(AdminProfileService::class)
                            ->needs(ProfileRepoInterface::class)
                                ->give(AdminProfileRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
