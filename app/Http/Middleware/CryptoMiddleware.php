<?php

namespace App\Http\Middleware;

use App\Models\Team;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CryptoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $decoded = Team::where('id', session('team_id'))->first()->finalStatistic->decode_time;
        if ($decoded) {
            return $next($request);
        } else {
            return redirect()->back()->with('error', 'You need to decode the message first!');
        }
    }
}
