<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
        $user = Auth::user();

        // Check the role ID
        if ($user->role_id == 1) {
            return $next($request);
        } else {
            abort(403, 'Unauthorized access');
        }
        } else {
            abort(401, 'Unauthenticated');
        }
    }
}
