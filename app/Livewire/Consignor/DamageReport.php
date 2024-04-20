<?php

namespace App\Livewire\Consignor;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DamageReport extends Component
{
    public function render()
    {
        return view('livewire.consignor.damage-report', [
            'orders' => Auth::user()->consignor->orders()->where('is_damage_reported', true)->paginate(10)
        ]);
    }
}
