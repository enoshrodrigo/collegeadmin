<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureAllowedDomain
{
    /**
     * List of allowed origins.
     */
    protected $allowedOrigins = [
        'http://localhost:8000', // adjust as needed
        'http://127.0.0.1:8000',
        'https://admin.marysvenner.net'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the Origin header from the request.
        /* $origin = $request->header('Origin'); */
        $origin = 'https://admin.marysvenner.net';

        // If the Origin header is missing or not allowed, return an error.
        if (!$origin || !in_array($origin, $this->allowedOrigins)) {
            return response()->json(['error' => 'Unauthorized Access'], 403);
        }

        return $next($request);
    }
}
