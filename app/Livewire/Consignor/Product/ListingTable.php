<?php

namespace App\Livewire\Consignor\Product;

use App\Enums\AlertType;
use App\Enums\ProductStatus;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListingTable extends Component
{
    use WithPagination;

    protected $listeners = ['refresh' => '$refresh'];

    public function updateStatus(Product $product)
    {
        if ($product->status === ProductStatus::Listed) {
            $status = ProductStatus::Unlisted;
            $alertType = AlertType::Danger;
        } else {
            $status = ProductStatus::Listed;
            $alertType = AlertType::Success;
        }

        if ($product->stock === 0) {
            $this->dispatch('alert', type: AlertType::Danger, message: __('alert.product.out_of_stock', ['attribute' => $product->name]));
            return;
        }

        $product->status = $status;
        $product->save();

        $this->dispatch('alert', type: $alertType, message: __('alert.product.status', ['attribute' => $product->name, 'status' => $status->value]));
    }

    public function delete(Product $product)
    {
        $product->delete();
        $this->dispatch('alert', type: AlertType::Success, message: __('alert.product.delete'));
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.consignor.product.listing-table', [
            'products' => Auth::user()->consignor->products()->paginate(10)
        ]);
    }
}
