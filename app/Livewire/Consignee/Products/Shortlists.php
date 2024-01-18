<?php

namespace App\Livewire\Consignee\Products;

use App\Enums\ContractStatus;
use App\Models\Contract;
use App\Models\Shortlist;
use App\Models\User;
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
        $this->redirect(route('consignee.contract', ['username' => $consignorUsername]), true);

        

        // $products = [];

        // foreach ($shortlists as $shortlist) {
        //     $products[] = $shortlist->product_id;

        //     $this->delete($shortlist);
        // }

        // $contract = Contract::create([
        //     'consignor_id' => User::where('username', $consignorUsername)->first()->id,
        //     'generated_contract' => '',
        //     'status' => ContractStatus::Pending,
        // ]);
    }

    public function delete(Shortlist $shortlist): void
    {
        $shortlist->delete();
    }

    public function render()
    {
        $consignee = Auth::user()->consignee;

        if ($consignee->shortlists()->count()) {
            $shortlists = $consignee->shortlists()->with('product.consignor')->get();

            $groupedShortlists = $shortlists->groupBy(function ($item) {
                return optional($item->product->consignor->user)->username;
            });
        } else {
            $groupedShortlists = new Collection();
        }

        return view('livewire.consignee.products.shortlists', [
            'groupedShortlists' => $groupedShortlists,
        ]);
    }
}
