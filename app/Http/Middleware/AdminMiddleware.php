<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$args ): Response
    {
    
        if (!session('isAdmin')){
            session()->flush();
            return redirect()->to(route('admin.login'))->with('error','You are not authorized to access this page');
        }
        return $next($request);
    }
}
