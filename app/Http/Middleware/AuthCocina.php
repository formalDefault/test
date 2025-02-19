<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCocina
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('cocina')) {
            return redirect()->route('cocina.login');
        }

        return $next($request);
    }
}
