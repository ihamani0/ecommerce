<?php

namespace App\Providers;

use App\Contracts\Backend\ProfileRepoInterface;
use App\Contracts\Backend\ProfileServiceInterface;
use App\Repositories\AdminProfileRepo;
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
        //for vendor
        $this->app->bind(ProfileServiceInterface::class , VendorProfileService::class );
        $this->app->bind(ProfileRepoInterface::class , VendorProfileRepo::class );
        //for admin
        $this->app->bind(ProfileRepoInterface::class , AdminProfileRepo::class );
        $this->app->bind(ProfileServiceInterface::class , AdminProfileService::class );

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
