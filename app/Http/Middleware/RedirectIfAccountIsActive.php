<?php

namespace App\Http\Middleware;

use App\Enums\UserStatus;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAccountIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->isNotAdmin()) {
            if (Auth::user()->status === UserStatus::Active) {
                return Auth::user()->redirectHome();
            }
        }

        return $next($request);
    }
}
