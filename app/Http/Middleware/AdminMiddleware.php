<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // checks if authenticated user is super admin or admin
        if (
            Auth::user()->type === 0 ||
            Auth::user()->type === 1 ||
            Auth::user()->type === 3 ||
            Auth::user()->type === 4
        ) {
            return $next($request);
        }
        abort(404);
    }
}
