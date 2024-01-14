<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFactorAuthenticationRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthenticationController extends Controller
{
    public function create(): View
    {
        Auth::user()->sendTwoFactorVerificationCode();
        return view('auth.two-factor');
    }

    public function verify(TwoFactorAuthenticationRequest $request): RedirectResponse
    {
        $request->verifyTwoFactorVerification();

        return Auth::user()->redirectHome();
    }

    public function send(): RedirectResponse
    {
        Auth::user()->sendDeviceVerificationCode();
        
        return back()->with('alert', [
            'type' => 'success',
            'message' => 'Verification sent successfully!'
        ]);
    }
}
