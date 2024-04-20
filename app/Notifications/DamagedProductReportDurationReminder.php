<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class DamagedProductReportDurationReminder extends Notification implements ShouldQueue
{
    use Queueable;
    
    public function __construct(
        public Order $order
    )
    {
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("ORDER " . Str::upper($this->order->reference_number) . " Damaged Product Reminder!")
                    ->greeting("Hello {$notifiable->name},")
                    ->line('You have 7 days to report and return any damaged product you have received. Please be advised that a necessary proof such as pictures is necesseray!')
                    ->line('Thank you for using our application!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Damaged Product Reminder!',
            'message' => 'You have 7 days to report and return any damaged product you have received for ORDER ' . $this->order->reference_number . '. Please be advised that a necessary proof such as pictures is necesseray!'
        ];
    }
}
