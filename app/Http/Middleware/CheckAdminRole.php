<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the authenticated user has the 'admin' role
        if (Auth::check() && Auth::user()->userRole === 'admin') {
            return $next($request);
        }

        // If the user doesn't have the 'adaa' role, redirect them to the login page with an error message
        return redirect()->route('login')->with('error', 'Access denied. You do not have permission to access this page.');
    }
}
