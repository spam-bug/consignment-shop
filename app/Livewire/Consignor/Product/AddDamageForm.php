<?php

namespace App\Livewire\Consignor\Product;

use App\Enums\AlertType;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class AddDamageForm extends Component
{
    public ?Product $product = null;
    public string $identifier = 'add-damage-form';

    public string|int $quantity = '';
    public string $remark = '';

    protected $rules = [
        'quantity' => ['required', 'integer', 'min:1'],
    ];

    #[On('open-modal')]
    public function show(Product $product, string $identifier)
    {
        if ($this->identifier !== $identifier) return;

        $this->product = $product;
    }

    public function save()
    {
        $this->withValidator(function ($validator) {
            $validator->after(function ($validator) {
                if ($this->product->stock < $this->quantity) {
                    $validator->errors()->add('quantity', 'Not enough product stock');
                }

                if ($this->product->stock === 0) {
                    $validator->errors()->add('quantity', 'Product is out of stock');
                }
            });
        });

        $this->product->update(['stock' => $this->product->stock - $this->quantity]);
        $this->product->damageRecords()->create($this->except(['product', 'identifier']));

        $this->dispatch('close-modal');
        $this->dispatch('refresh');
        $this->dispatch('alert', type: AlertType::Success, message: __('alert.product.damage', ['attribute' => $this->product->name]));

        $this->resetExcept('identifier');
    }
}
