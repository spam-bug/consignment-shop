<?php

namespace App\Livewire\Consignee\Products;

use App\Models\Consignor as ModelsConsignor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Consignor extends Component
{
    public $consignor;

    public function mount(ModelsConsignor $consignor)
    {
        $this->consignor = $consignor;
    }

    public function message()
    {
        $consignee = Auth::user()->consignee;

        if ($consignee->conversations()->where('consignor_id', $this->consignor->id)->exists()) {
            $conversation =  $consignee->conversations()->where('consignor_id', $this->consignor->id)->first();
        } else {
            $conversation = Auth::user()->consignee->conversations()->create([
                'consignor_id' => $this->consignor->id,
            ]);
        }
        
        $this->redirect(route('consignee.inbox', ['conversation' => $conversation->id]), true);
    }

    public function render()
    {
        return view('livewire.consignee.products.consignor');
    }
}
