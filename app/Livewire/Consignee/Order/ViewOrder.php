<?php

namespace App\Livewire\Consignee\Order;

use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewOrder extends Component
{
    public ?Order $order = null;
    public string $identifier = 'view-order';

    #[On('open-modal')]
    public function show(Order $order, string $identifier)
    {
        if ($this->identifier !== $identifier) return;

        $this->order = $order;
    }

    public function render()
    {
        return view('livewire.consignee.order.view-order');
    }
}
