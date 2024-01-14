<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TwoFactorAuthenticationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }
    
    public function rules(): array
    {
        return [
            'code' => 'required',
        ];
    }

    public function verifyTwoFactorVerification(): void
    {
        if (session()->has('two_factor_authentication')) {
            $timestamp = session('two_factor_authentication.timestamp');
            $verificationCode = session('two_factor_authentication.code');

            if (now()->diffInMinutes($timestamp) > 5 || $this->code !== $verificationCode) {
                throw ValidationException::withMessages(['code' => 'Invalid verification code.']);
            }
        }

        session(['two_factor_authentication.verified' => true]);
    }
}
