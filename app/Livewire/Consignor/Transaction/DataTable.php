<?php

namespace App\Livewire\Consignor\Transaction;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.consignor.transaction.data-table', [
            'transactions' => Auth::user()->consignor->transactions()->paginate(10),
        ]);
    }
}
