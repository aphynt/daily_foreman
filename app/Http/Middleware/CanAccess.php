<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanAccess
{
    public function handle($request, Closure $next)
    {
        $routeName = $request->route()?->getName();

        if (!$routeName) {
            return $next($request);
        }

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!canAccess($routeName)) {
            return redirect()->route('dashboard.index')->with('info', 'Anda tidak diizinkan mengakses halaman ini');
        }

        return $next($request);
    }
}
