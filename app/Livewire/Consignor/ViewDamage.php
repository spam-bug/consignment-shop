<?php

namespace App\Livewire\Consignor;

use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewDamage extends Component
{
    public ?Order $order = null;
    public string $identifier = 'view-damage';

    #[On('open-modal')]
    public function show(Order $order, string $identifier)
    {
        if ($this->identifier !== $identifier) return;

        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.consignor.view-damage');
    }
}
