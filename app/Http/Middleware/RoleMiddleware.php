<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Unauthorized access.');
        }

        if (auth()->user()->status !== 'active') {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Your account is not active. Please contact admin.');
        }

        return $next($request);
    }
}
