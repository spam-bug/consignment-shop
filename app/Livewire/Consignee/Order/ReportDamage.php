<?php

# TODO: Handle the uploading of proof of damage.


namespace App\Livewire\Consignee\Order;

use App\Models\Order;
use Auth;
use Illuminate\Validation\Validator;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ReportDamage extends Component
{
    use WithFileUploads;

    public ?Order $order = null;
    public string $identifier = 'report-damage';
    
    public array $items = [];
    public array $medias = [];

    #[On('open-modal')]
    public function show(Order $order, string $identifier)
    {
        if ($this->identifier !== $identifier) return;

        $this->order = $order;

        if ($order->items()->sum('damage_quantity')) {
            foreach ($order->items as $orderedItem) {
                if ($orderedItem->damage_quantity) {
                    $this->items[] = [
                        'id' => $orderedItem->id,
                        'quantity' => $orderedItem->damage_quantity,
                    ];
                    
                    $this->medias = $order->add_proof_of_damage ?? [];
                }
            }

            return;
        }
        
        $this->addItem();
    }

    public function submit()
    {
        $this->withValidator(function (Validator $validator) {
            $validator->after(function ($validator) {
                foreach ($this->items as $index => $item) {
                    $orderedItem = $this->order->items()->find($item['id']);
                    
                    if (!is_null($orderedItem) && $item['quantity'] > $orderedItem->quantity) {
                        $validator->errors()->add("items.{$index}.id", "Damage quantity should not exceed the item quantity!");
                    }
                }
            });
        })->validate(
            rules: [
                'items.*.*' => 'required',
                'medias' => 'required|min:1',
            ],
            attributes: [
                'items.*.*' => 'item'
            ]
        );

        $paths = [];
        
        foreach ($this->medias as $media) {
            $paths[] = $media->store('proof');    
        }

        foreach ($this->items as $item) {
            $orderedItem = $this->order->items()->find($item['id']);

            $orderedItem->damage_quantity = $item['quantity'];
            $orderedItem->save();

            $product = Auth::user()->consignee->products()->where('product_id', $orderedItem->product->id)->first();

            $product->stock = $product->stock - $orderedItem->damage_quantity;
            $product->total = $product->total - ($orderedItem->product->price * $orderedItem->damage_quantity);
            $product->save();
        }

        $this->order->add_proof_of_damage = $paths;
        $this->order->is_damage_reported = true;
        $this->order->save();

        $this->dispatch('refresh');
        $this->cancel();
    }

    public function cancel()
    {
        $this->order = null;
        $this->items = [];

        $this->dispatch('close-modal');
    }

    public function addItem()
    {
        $this->items[] = [
            "id" => '',
            'quantity' => 0,
        ];
    }

    public function removeItem(int $index)
    {
        unset($this->items[$index]);
    }

    public function removeMedia(int $index)
    {
        unset($this->medias[$index]);
    }

    public function render()
    {
        return view('livewire.consignee.order.report-damage');
    }
}
