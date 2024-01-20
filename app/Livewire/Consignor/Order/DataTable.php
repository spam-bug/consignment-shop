<?php

namespace App\Livewire\Consignor\Order;

use App\Enums\OrderStatus;
use App\Enums\TransactionStatus;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;

    protected $listeners = ['refresh' => '$refresh'];

    public function cancel(Order $order)
    {
        $order->update(['status' => OrderStatus::Cancelled]);
        $this->dispatch('refresh');
    }

    public function shipOrder(Order $order)
    {
        foreach ($order->items as $item) {
            $item->product->stock -= $item->quantity;
            $item->product->save();
        }

        $order->update([
            'status' => OrderStatus::Shipped,
        ]);

        $this->dispatch('refresh');
    }

    public function paid(Order $order)
    {
        $order->transaction()->update(['status' => TransactionStatus::Paid]);
    }
    
    public function render()
    {
        return view('livewire.consignor.order.data-table', [
            'orders' => Auth::user()->consignor->orders()->paginate(10),
        ]);
    }
}
