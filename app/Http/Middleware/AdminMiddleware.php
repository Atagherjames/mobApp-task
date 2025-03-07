<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Use the correct authentication guard for admin
        if (auth('admin')->check() && auth('admin')->user()->role === 'admin') {
            return $next($request);
        }

        return response()->json(['message' => 'Access denied'], 403);
    }
}
