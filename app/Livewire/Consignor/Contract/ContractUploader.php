<?php

namespace App\Livewire\Consignor\Contract;

use App\Enums\ContractStatus;
use App\Models\Contract;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ContractUploader extends Component
{
    use WithFileUploads;

    public ?Contract $contract = null;
    public string $identifier = 'contract-uploader';

    public $signedContract = '';

    #[On('open-modal')]
    public function show(Contract $contract, string $identifier)
    {
        if ($this->identifier !== $identifier) return;

        $this->contract = $contract;
    }

    public function save()
    {
        $this->validate([
            'signedContract' => ['required', 'mimes:pdf'],
        ]);

        $consignee = $this->contract->consignee->user->username;

        $path = $this->signedContract->store("contracts/{$consignee}");

        $this->contract->update([
            'uploaded_consignor_contract' => $path,
            'status' => ContractStatus::UnderReview,
        ]);

        $this->dispatch('close-modal');
        $this->dispatch('refresh');
        $this->resetExcept('identifier');
    }

    public function render()
    {
        return view('livewire.consignor.contract.contract-uploader');
    }
}
