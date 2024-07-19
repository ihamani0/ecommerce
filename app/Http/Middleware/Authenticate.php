<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if(Auth::check()){
            $user = Auth::user();
            $user->last_activity=  Carbon::now()->subMinute(5) ;
            $user->save();
        }

        return $request->expectsJson() ? null : route('vendor.login');
    }
}
