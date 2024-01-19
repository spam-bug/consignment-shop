<?php

namespace App\Livewire\Consignee\Products;

use App\Models\Product;
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

    public function render()
    {
        return view('livewire.consignee.products.orderable-product-preview');
    }
}
