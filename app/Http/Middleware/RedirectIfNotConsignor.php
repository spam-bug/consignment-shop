<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotConsignor
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isNotConsignor()) {
            return Auth::user()->redirectHome();
        }

        return $next($request);
    }
}
