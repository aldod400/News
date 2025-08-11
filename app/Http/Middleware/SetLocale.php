<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from session, URL parameter, or default to Arabic
        $locale = $request->get('lang') ?? Session::get('locale', 'ar');

        // Validate locale
        if (!in_array($locale, ['ar', 'en'])) {
            $locale = 'ar';
        }

        // Set the locale
        App::setLocale($locale);
        Session::put('locale', $locale);
        
        // Set Carbon locale as well for date formatting
        Carbon::setLocale($locale === 'ar' ? 'ar' : 'en');

        return $next($request);
    }
}
