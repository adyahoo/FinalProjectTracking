<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsProjectManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(empty($request->user()) || !$request->user()->isProjectManager)
            return redirect()->route('login');

        return $next($request);
    }
}
