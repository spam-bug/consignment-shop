<?php

namespace App\Listeners;

use App\Notifications\TwoFactorVerificationCode;

class SendTwoFactorVerificationCodeNotification
{
    public function handle(object $event): void
    {
        $event->user->notify(new TwoFactorVerificationCode($event->verificationCode));
    }
}
