<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        if (!$request->user()->hasRole($roles)) {
            return abort(403);
        }

        return $next($request);
    }
}
