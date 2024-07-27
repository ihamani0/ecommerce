<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LastActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $guards = ['web', 'admin'];

        foreach ($guards as $guard){

            if(Auth::guard($guard)->check()){
                Auth::guard($guard)->user()->last_activity = Carbon::now();
                Auth::guard($guard)->user()->save();
                break;
            }
        }

        return $next($request);
    }
}
