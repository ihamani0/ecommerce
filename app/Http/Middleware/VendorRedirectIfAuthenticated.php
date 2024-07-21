<?php

namespace App\Http\Middleware;

use App\Constants\Constants;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if the user is auth  redirect to his dashboard
        if (auth()->check() && auth()->user()->role === 'vendor') {
            return redirect()->route(Constants::VENDOR_DASHBOARD);
        }
        return $next($request);  /*contain the request to login page */
    }
}
