<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


   class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->role === 'admin') {
            return $next($request); // Allow access if the user is an admin
        }

        return response()->json(['message' => 'Access denied'], 403); 
    }
}

