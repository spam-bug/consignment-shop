<?php

namespace App\Livewire\Consignee;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.consignee'), Title('My Products')]
class MyProduct extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.consignee.my-product', [
            'products' => Auth::user()->consignee->products()->paginate(10),
        ]);
    }
}
