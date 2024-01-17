<?php

namespace App\Livewire\Consignee\Products;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.consignee'), Title('Products')]
class LookUpPreview extends Component
{
    public Product $product;

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    public function shortList(): void
    {
        Auth::user()->consignee->shortlists()->create(['product_id' => $this->product->id]);
    }

    public function render(): View
    {
        return view('livewire.consignee.products.look-up-preview');
    }
}
