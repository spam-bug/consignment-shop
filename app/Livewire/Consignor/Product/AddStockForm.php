<?php

namespace App\Livewire\Consignor\Product;

use App\Enums\AlertType;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class AddStockForm extends Component
{
    public ?Product $product = null;
    public string $identifier = 'add-stock-form';

    public string|int $quantity = '';
    public string $remark = '';


    #[On('open-modal')]
    public function show(Product $product, string $identifier)
    {
        if ($this->identifier !== $identifier) return;

        $this->product = $product;
    }

    public function save()
    {
        $this->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $this->product->update(['stock' => $this->product->stock + $this->quantity]);
        $this->product->stockRecords()->create($this->except(['product', 'identifier']));

        $this->dispatch('close-modal');
        $this->dispatch('refresh');
        $this->dispatch('alert', type: AlertType::Success, message: __('alert.product.restock', ['attribute' => $this->product->name]));

        $this->resetExcept('identifier');
    }
}
