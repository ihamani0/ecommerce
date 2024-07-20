<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VisitorLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($this->shouldTrackRequest($request) && !$this->hasVisitedToday($request)){

            \App\Models\VisitorLog::create([
                "ip_address" => $request->ip(),
                "user_agent" => $request->userAgent()
            ]);

            $request->session()->put('last_visit_date', now()->toDateString());
        }

        return $next($request);
    }

    private function hasVisitedToday(Request $request): bool
    {
        return $request->session()->has('last_visit_date') &&
            $request->session()->get('last_visit_date') == now()->toDateString();
    }

    private function shouldTrackRequest(Request $request): bool
    {
        return $request->method() === 'GET' && !$request->ajax() && $request->acceptsHtml();
    }
}
