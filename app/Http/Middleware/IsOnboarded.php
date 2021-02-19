<?php

namespace App\Http\Middleware;

use Closure;

class IsOnboarded
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
        if(!$request->user()->home_id)
            return redirect('/onboarding');
        return $next($request);
    }
}
