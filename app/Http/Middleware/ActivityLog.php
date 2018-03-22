<?php

namespace App\Http\Middleware;

use Closure;

class ActivityLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()) {
            \Log::info('UserID: ' . auth()->user()->id . ' with the ip of ' . $request->ip() . ", using " . $request->userAgent() . " is visiting " . $request->getRequestUri() . " with " . $request->method() . " method");
        } else {
            \Log::info('Unregistered user  with the ip of ' . $request->ip() . ", using " . $request->userAgent() . " is visiting " . $request->getRequestUri() . " with " . $request->method() . " method");
        }
        return $next($request);
    }
}
