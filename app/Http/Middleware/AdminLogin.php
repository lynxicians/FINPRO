<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            $roleId = auth()->user()->role_id;

            // Check if the user_id is 2
            if ($roleId == 2) {
                return $next($request); // Proceed with the request
            }
        }

        // User is not authenticated or doesn't have user_id = 2, deny access
        return response('Unauthorized.', 401);
    }
}
