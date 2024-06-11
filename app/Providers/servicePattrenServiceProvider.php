<?php

namespace App\Providers;

use App\Contracts\Backend\CrudInterface;
use App\Contracts\Backend\ProductInterface;
use App\Contracts\Backend\ProfileRepoInterface;
use App\Contracts\Backend\ProfileServiceInterface;

use App\Contracts\Backend\VendorInterface;
use  App\Http\Controllers\backend\Admin\AdminProfileController;
use App\Http\Controllers\backend\Admin\Brand\BrandController;
use App\Http\Controllers\backend\Admin\Category\CategoryController;
use App\Http\Controllers\backend\Admin\Category\SubcategoryController;
/*use App\Http\Controllers\backend\Admin\Products\ProductsController;*/

use App\Http\Controllers\backend\Admin\Products\ProductsController as adminProductsController;
use App\Http\Controllers\backend\Vendor\Products\ProductsController as vendorProductsController;

use App\Http\Controllers\backend\Admin\Vendor\VendorStatus;
use App\Http\Controllers\backend\Vendor\VendorController;
use App\Http\Controllers\backend\Vendor\VendorProfileController;
use App\Repositories\AdminProfileRepo;

use App\Repositories\Backend\BrandRepo;
use App\Repositories\Backend\CategoryRepo;
use App\Repositories\Backend\ProductRepo;
use App\Repositories\Backend\SubcategoryRepo;
use App\Repositories\Backend\VendorRepo;
use App\Repositories\VendorProfileRepo;
use App\Services\Backend\AdminProfileService;
use App\Services\Backend\VendorProfileService;



use Illuminate\Support\ServiceProvider;

class servicePattrenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

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
