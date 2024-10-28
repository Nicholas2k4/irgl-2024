<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('team_id')) {
            return redirect()->route('login'); // Adjust the route as needed
        }

        return $next($request);
    }
}
