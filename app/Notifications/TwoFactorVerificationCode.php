<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorVerificationCode extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $verificationCode)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Two-Factor Authentication Verification Code')
                    ->greeting("Hi {$notifiable->name},")
                    ->line("To complete your login, please enter the following two-factor authentication code: {$this->verificationCode}");
    }
}
