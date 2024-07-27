<?php

namespace App\Http\Middleware;

use App\Constants\Constants;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsEnableAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if the user is authenticated as an admin
        if (Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();

            // Check if the admin's status is enabled
            if (!$admin->status) {
                // Logout the admin and redirect to login page with a message
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with(['isNotActive'=> 'Your account is not active yet.
                 Please wait for approval from the Root.']);
            }
        } else {
            // If not authenticated, redirect to login page
            return redirect()->route('admin.login');
        }


        return $next($request);
    }
}
