<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
        \Log::info('IsAdmin Middleware: Checking user role.');
    
        if (Auth::check()) {
            \Log::info('IsAdmin Middleware: Authenticated user role - ' . Auth::user()->role);
            if (Auth::user()->role === 'admin') {
                \Log::info('IsAdmin Middleware: User is admin. Access granted.');
                return $next($request);
            } else {
                \Log::warning('IsAdmin Middleware: User is not admin. Access denied.');
            }
        } else {
            \Log::warning('IsAdmin Middleware: User not authenticated.');
        }
    
        abort(403, 'Unauthorized');
    }
    
}
