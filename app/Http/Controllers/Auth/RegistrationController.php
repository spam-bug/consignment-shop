<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegistrationRequest $request): RedirectResponse
    {
        $user = $request->register();

        return $user->redirectHome();
    }
}
