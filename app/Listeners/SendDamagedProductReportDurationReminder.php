<?php

namespace App\Listeners;

use App\Notifications\DamagedProductReportDurationReminder;

class SendDamagedProductReportDurationReminder
{
    public function handle(object $event): void
    {
        auth()->user()->notify(new DamagedProductReportDurationReminder($event->order));
    }
}
