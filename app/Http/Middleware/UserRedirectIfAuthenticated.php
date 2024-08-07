<?php

namespace App\Http\Middleware;

use App\Constants\Constants;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.  /logIN
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->check() && auth()->user()->role === 'user') {

            return redirect()->route(Constants::USER_ACCOUNT_DASHBOARD);
        }

        return $next($request);
    }
}
