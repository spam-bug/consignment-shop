<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotConsignee
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isNotConsignee()) {
            Auth::user()->redirectHome();
        }

        return $next($request);
    }
}
