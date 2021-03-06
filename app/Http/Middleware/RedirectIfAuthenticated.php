<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->hasRole('superadmin')){
                return  redirect()->route('dashboard.home');
            } else if (Auth::user()->hasRole('eo')) {
                return  redirect()->route('organizer.home');
            } else if (Auth::user()->hasRole('partner')) {
                return  redirect()->route('partner.home');
            }
        }

        return $next($request);
    }
}
