<?php

namespace App\Livewire\Consignee;

use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.consignee'), Title('Inbox')]
class Inbox extends Component
{
    #[Url(except: '', keep: true)]
    public $c = '';

    public string $message = '';

    public function send()
    {
        if (empty($this->message)) return;

        $conversation = Conversation::find($this->c);

        $conversation->messages()->create([
            'model_type' => get_class(Auth::user()->consignee),
            'model_id' => Auth::id(),
            'content' => $this->message,
        ]);

        $this->message = '';
    }

    public function render()
    {
        if (! empty($this->conversation)) {
            $conversation = Conversation::find($this->c);
        }

        return view('livewire.consignee.inbox', [
            'conversations' => Auth::user()->consignee->conversations()->orderBy('created_at', 'desc')->get(),
            'conversation' => $conversation ?? null,
        ]);
    }
}
