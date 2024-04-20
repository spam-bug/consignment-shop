<?php

namespace App\Livewire\Consignee;

use Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DamageReports extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.consignee.damage-reports', [
            'orders' => Auth::user()->consignee->orders()->where('is_damage_reported', true)->paginate(10)
        ]);
    }
}
