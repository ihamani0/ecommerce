<?php

namespace App\Providers;

use App\Contracts\Backend\CrudInterface;
use App\Contracts\Backend\ProfileRepoInterface;
use App\Contracts\Backend\ProfileServiceInterface;

use App\Contracts\Backend\VendorInterface;
use  App\Http\Controllers\backend\Admin\AdminProfileController;
use App\Http\Controllers\backend\Admin\Brand\BrandController;
use App\Http\Controllers\backend\Admin\Category\CategoryController;
use App\Http\Controllers\backend\Admin\Category\SubcategoryController;
use App\Http\Controllers\backend\Vendor\VendorController;
use App\Repositories\AdminProfileRepo;

use App\Repositories\Backend\BrandRepo;
use App\Repositories\Backend\CategoryRepo;
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

        //--------------------for VendorsStatus--------------------
        $this->app->bind(VendorInterface::class, VendorRepo::class);
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
        $this->app->bind(ProfileRepoInterface::class, VendorProfileRepo::class);
        $this->app->bind(ProfileServiceInterface::class, VendorProfileService::class);
        //------------------------------------------------------------
        //---------------------for admin--------------------
        $this->app->bind(ProfileRepoInterface::class, AdminProfileRepo::class);
        $this->app->bind(ProfileServiceInterface::class, AdminProfileService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
