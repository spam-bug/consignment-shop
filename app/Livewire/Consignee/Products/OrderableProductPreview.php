<?php

namespace App\Livewire\Consignee\Products;

use App\Enums\AlertType;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.consignee'), Title('Orderable')]
class OrderableProductPreview extends Component
{
    public Product $product;

    public int $quantity = 1;

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    public function addToCart()
    {
        $cartItem = Cart::firstOrNew(
            ['consignee_id' => Auth::user()->consignee->id, 'product_id' => $this->product->id],
        );
        
        $cartItem->quantity += $this->quantity;
        $cartItem->total = (float) str_replace(',', '', $this->product->price) * $cartItem->quantity;
        $cartItem->save();

        $this->dispatch('alert', type: AlertType::Success, message: "Item has been added to cart.");
    }

    public function render()
    {
        return view('livewire.consignee.products.orderable-product-preview');
    }
}
