<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLockScreen
{
    public function handle(Request $request, Closure $next): Response
    {
        // Skip if user is not authenticated
        if (!Auth::check()) {
            return $next($request);
        }

        // Check if user is "locked"
        if (session('is_locked', false)) {
            // Store the intended URL before redirecting to lock
            if (!$request->is('lock') && !$request->is('lock/unlock')) {
                session(['lockscreen_intended_url' => $request->fullUrl()]);
            }

            return redirect()->route('lock');
        }

        return $next($request);
    }
}