<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        // Check if admin is logged in
        if (!$request->session()->has('admin_id')) {

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Please login first.'
                );
        }


        // User is authenticated
        return $next($request);
    }
}
