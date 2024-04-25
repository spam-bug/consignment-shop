<?php

namespace App\Livewire\Consignor\Product;

use App\Enums\AlertType;
use App\Enums\ProductStatus;
use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditForm extends Component
{
    use WithFileUploads;

    public ProductForm $form;
    public Collection $categories;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount(Product $product)
    {
        $this->form->set($product);
        $this->categories = Category::all();
    }

    public function updatedFormPrice($value)
    {
        if (preg_match('/^-?\d+(\.\d+)?$/', $value)) {
            $this->form->price = number_format($value, 2);
        }
    }

    public function updatedFormSellingPrice($value)
    {
        if (preg_match('/^-?\d+(\.\d+)?$/', $value)) {
            $this->form->selling_price = number_format($value, 2);
        }
    }

    public function save()
    {
        $product = $this->form->updateProduct();

        $this->redirectRoute('consignor.products');
        $this->dispatch('flash-message', type: AlertType::Success, message: __('alert.product.update', ['attribute' => $product->name]))->to(ListingTable::class);
    }

    public function updateStatus()
    {
        if ($this->form->product->status === ProductStatus::Listed) {
            $status = ProductStatus::Unlisted;
            $alertType = AlertType::Danger;
        } else {
            $status = ProductStatus::Listed;
            $alertType = AlertType::Success;
        }


        if ($this->form->product->stock === 0) {
            $this->dispatch('alert', type: AlertType::Danger, message: __('alert.product.out_of_stock', ['attribute' => $this->form->product->name]));
            return;
        }

        $this->form->product->status = $status;
        $this->form->product->save();

        $this->dispatch('alert', type: $alertType, message: __('alert.product.status', ['attribute' => $this->form->product->name, 'status' => $status->value]));
    }

    public function delete()
    {
        $this->form->product->delete();

        $this->dispatch('alert', type: AlertType::Success, message: __('alert.product.delete'));
        $this->redirect(route('consignor.products'), true);
    }

    public function removePhoto($index)
    {
        unset($this->form->photos[$index]);
    }
}
