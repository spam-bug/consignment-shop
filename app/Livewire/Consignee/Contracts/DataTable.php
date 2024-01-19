<?php

namespace App\Livewire\Consignee\Contracts;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class DataTable extends Component
{
    use WithPagination;

    protected $listeners = ['refresh' => '$refresh'];

    public function download(string $file)
    {
        return Storage::download("$file");
    }

    public function render()
    {
        return view('livewire.consignee.contracts.data-table', [
            'contracts' => Auth::user()->consignee->contracts()->latest()->paginate(10)
        ]);
    }
}
