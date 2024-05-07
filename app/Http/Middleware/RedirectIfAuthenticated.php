<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;


        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                //si the user is authenticated
                //redirect to the correct dashboard depending on the role
                //si if the role is of auth user is the same as the role in the middleware
                //redirect to the correct dashboard depending on the role
                return redirect("/");
            }
        }


        return $next($request);
    }
}



