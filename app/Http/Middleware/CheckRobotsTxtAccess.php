<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRobotsTxtAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user has Super Admin role
        if (!Auth::check() || !Auth::user()->hasRole('Super Admin')) {
            abort(403, 'غير مصرح لك بالدخول لهذه الصفحة');
        }

        return $next($request);
    }
}
