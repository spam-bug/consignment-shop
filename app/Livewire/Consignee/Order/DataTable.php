<?php

namespace App\Livewire\Consignee\Order;

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

    public function received(Order $order)
    {
        $order->transaction()->create([
            'consignee_id' => Auth::user()->consignee->id,
            'consignor_id' => $order->consignor->id,
            'total' => $order->total,
            'status' => TransactionStatus::Pending,
        ]);

        $order->update(['status' => OrderStatus::Received]);

        foreach ($order->items as $item) {
            $product = Auth::user()->consignee->products()->find($item->product->id);

            if ($product) {
                $product->stock = $product->stock + $item->quantity;
                $product->total = $product->total + $item->total;
                $product->save();
            } else {
                Auth::user()->consignee->products()->create([
                    'product_id' => $item->product->id,
                    'stock' => $item->quantity,
                    'stock_threshold' => 5,
                    'total' => $item->total,
                ]);
            }
        }

        $order->sendDamagedProductReportDurationReminder();

        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.consignee.order.data-table', [
            'orders' => Auth::user()->consignee->orders()->paginate(10)
        ]);
    }
}
