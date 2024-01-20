<?php

namespace App\Livewire\Consignee;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.consignee'), Title('Cart')]
class ShoppingCart extends Component
{
    public array $selectedItems = [];
    public $totalAmount = 0;

    public function updatedSelectedItems()
    {
        foreach ($this->selectedItems as $item) {
            $item = json_decode($item);
            $total = 0;

            $total += $item->total;
        }
        
        $this->totalAmount += $item->total;
    }

    public function checkout()
    {
        session()->put('checkout_items', $this->selectedItems);
        $this->redirect(route('consignee.checkout'), true);
    }

    public function render()
    {
        $consignee = Auth::user()->consignee;

        if (! $consignee->cartItems->count()) {
            $items = new Collection();
        } else {
            $cartItems = $consignee->cartItems()->with('product.consignor')->get();

            $items = $cartItems->groupBy(function ($item) {
                return optional($item->product->consignor->user)->username;
            });
        }

        return view('livewire.consignee.shopping-cart', [
            'groupedItems' => $items
        ]);
    }
}
