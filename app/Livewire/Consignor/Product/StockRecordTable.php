<?php

namespace App\Livewire\Consignor\Product;

use App\Models\Product;
use Livewire\Component;

class StockRecordTable extends Component
{
    public Product $product;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.consignor.product.stock-record-table', [
            'stocks' => $this->product->stockRecords,
        ]);
    }
}
