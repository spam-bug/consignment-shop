<?php

namespace App\Models;

use App\Enums\UserStatus;
use App\Events\DeviceVerification;
use App\Events\TwoFactorAuthentication;
use App\Models\Concerns\HasRole;
use App\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRole;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => UserStatus::class,
    ];

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail);
    }

    public function sendTwoFactorVerificationCode(): void
    {
        if (session()->has('two_factor_authentication')) {
            $timestamp = session('two_factor_authentication.timestamp');

            if (now()->diffInMinutes($timestamp) < 5) {
                return;   
            }

        }

        $verificationCode = Str::upper(Str::random(6));

        session(['two_factor_authentication' => [
            'code' => $verificationCode,
            'verified' => false,
            'timestamp' => now(),
        ]]);

        event(new TwoFactorAuthentication($this, $verificationCode));
    }

    public function photo(): string
    {
        return "https://api.dicebear.com/7.x/initials/svg?seed={$this->name}";
    }
}
