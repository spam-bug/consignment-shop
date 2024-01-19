<?php

namespace App\Livewire\Consignor\Contract;

use App\Enums\ContractStatus;
use App\Models\Contract;
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
        return Storage::download($file);
    }

    public function approve(Contract $contract)
    {
        $contract->update(['status' => ContractStatus::Approve]);
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.consignor.contract.data-table', [
            'contracts' => Auth::user()->consignor->contracts()
            ->whereIn('status', [ContractStatus::Approve, ContractStatus::UnderReview])->paginate(10)
        ]);
    }
}
