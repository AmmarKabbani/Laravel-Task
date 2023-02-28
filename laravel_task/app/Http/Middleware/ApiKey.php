<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->header('api_key') === 'NAS'){
            return $next($request);
        }else{
            return response()->json([
                'status' => 'An error has occurred...',
                'message' => 'Unauthorized !',
            ], 401);
        }
    }
}
