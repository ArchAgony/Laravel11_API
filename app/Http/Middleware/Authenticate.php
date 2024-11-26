<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('x-kunci-sukses') != 'kerja keras dan orang dalam'){
            return response()->json(['message' => 'anda kurang kerja keras dan ordal']);
        }
        return $next($request);
    }
}
