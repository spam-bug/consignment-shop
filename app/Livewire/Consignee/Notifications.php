<?php

namespace App\Livewire\Consignee;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{
    public $hasUnreadNotification = false;

    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        $this->hasUnreadNotification = (bool) Auth::user()->unreadNotifications->count();

        return view('livewire.consignee.notifications', [
            'notifications' => Auth::user()->notifications
        ]);
    }
}
