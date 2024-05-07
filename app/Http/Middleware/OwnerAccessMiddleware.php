<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerAccessMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the request is coming from an owner (role is 'owner')
        if ($request->header('Role') !== 'owner') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
