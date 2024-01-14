<?php

namespace App\Livewire\Consignor\Product;

use App\Models\Product;
use Livewire\Component;

class DamageRecordTable extends Component
{
    public Product $product;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.consignor.product.damage-record-table', [
            'damages' => $this->product->damageRecords,
        ]);
    }
}
