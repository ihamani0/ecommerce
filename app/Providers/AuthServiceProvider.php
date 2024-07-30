<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define("isActive" , function (User $user){
           return  $user->status;
        });

        // Define a gate for each permission, or use a wildcard
        Gate::before(function (Admin $admin, $ability) {
            if ($admin->hasPermissionTo($ability)) {
                return true;
            }
            return false;
        });
    }
}
