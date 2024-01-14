<?php

namespace App\Http\Middleware;

use App\Enums\UserStatus;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAccountIsInactive
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isNotAdmin()) {
            if (Auth::user()->status === UserStatus::Inactive) {
                return redirect()->route('auth.activation');
            }
        }

        return $next($request);
    }
}
