<?php

namespace App\Http\Middleware;

use Closure;

class CheckGymAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->type === 1 && !auth()->user()->isPremium()) {
            abort(404);
        }
        return $next($request);
    }
}
