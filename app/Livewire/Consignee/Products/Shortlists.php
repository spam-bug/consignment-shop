<?php

namespace App\Livewire\Consignee\Products;

use App\Enums\ContractStatus;
use App\Models\Contract;
use App\Models\Shortlist;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.consignee'), Title('Shortlists')]
class Shortlists extends Component
{
    public function processContract(string $consignorUsername)
    {
        $consignee = Auth::user()->consignee;
        $consignor = User::where('username', $consignorUsername)->first()->consignor;

        $groupedShortlists = $this->getGroupedShorlists();
        $shortlists = $groupedShortlists[$consignorUsername];

        $filename = now()->timestamp . "-{$consignee->user->name}-{$consignor->user->name}.pdf";
        $path = "{$consignee->user->username}/$filename";

        $pdf = Pdf::loadView('pdf.contract', [
            'shortlists' => $shortlists,
            'consignor' => $consignor,
        ])->setPaper('legal');

        $pdf->output();

        $this->addWatermark($pdf);

        $pdf->save($path, "contracts");

        $contract = $this->createContract($consignee, $consignor, $path);
        $this->attachProducts($contract, $shortlists);

        $this->deleteShortlists($shortlists);
    }

    public function delete(Shortlist $shortlist): void
    {
        $shortlist->delete();
    }

    public function render()
    {
        return view('livewire.consignee.products.shortlists', [
            'groupedShortlists' => $this->getGroupedShorlists(),
        ]);
    }

    private function getGroupedShorlists(): Collection
    {
        $consignee = Auth::user()->consignee;

        if (!$consignee->shortlists()->count()) {
            return new Collection();
        }

        $shorlists = $consignee->shortlists()->with('product.consignor')->get();

        return $shorlists->groupBy(function ($item) {
            return optional($item->product->consignor->user)->username;
        });
    }

    private function addWatermark($pdf): void
    {
        $canvas = $pdf->getDomPDF()->getCanvas();

        $canvas->page_text(
            x: $canvas->get_width() / 5,
            y: $canvas->get_height() / 1.4,
            text: 'Consignment shop',
            font: 'sans-serif',
            size: 96,
            color: [0, 0, 0, "alpha" => 0.1],
            word_space: 0.0,
            char_space: 0.0,
            angle: -65,
        );
    }

    private function createContract($consignee, $consignor, $path)
    {
        return $consignee->contracts()->create([
            'consignor_id' => $consignor->id,
            'generated_contract' => "contracts/{$path}",
            'status' => ContractStatus::Pending,
            'expired_at' => now()->addYear(),
        ]);
    }

    private function attachProducts($contract, $shortlists)
    {
        $productIds = $shortlists->pluck('product.id')->toArray();

        $contract->products()->attach($productIds);
    }

    private function deleteShortlists($shortlists)
    {
        $shortlists->each(function ($shortlist) {
            $shortlist->delete();
        });
    }

}
