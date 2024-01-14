<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required',
        ];
    }

    public function authenticate(): Authenticatable
    {
        if (! Auth::attempt($this->validated())) {
            throw ValidationException::withMessages([
                'email' => 'Credentials did not match our records.'
            ]);
        }

        return Auth::user();
    }
}
