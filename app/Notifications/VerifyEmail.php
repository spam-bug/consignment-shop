<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as DefaultVerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmail extends DefaultVerifyEmail implements ShouldQueue
{
    use Queueable;
}
