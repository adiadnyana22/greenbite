<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->role_id != 1 && Auth::user()->role_id != 2 && Auth::user()->role_id == 3) return redirect()->route('home');
        if(Auth::check() && Auth::user()->role_id != 1 && Auth::user()->role_id != 3 && Auth::user()->role_id == 2) return redirect()->route('adminDashboard');

        return $next($request);
    }
}
