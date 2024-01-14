<?php

namespace App\Livewire\Consignor\Product;

use App\Enums\AlertType;
use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateForm extends Component
{
    use WithFileUploads;

    public ProductForm $form;
    public Collection $categories;

    public function mount(): void
    {
        $this->categories = Category::all();
        $this->form->category = $this->categories->first()->slug;
    }

    public function save()
    {
        $this->form->createProduct();

        $this->redirect(route('consignor.products'), true);
        $this->dispatch('alert', type: AlertType::Success, message: __('alert.product.update'));
    }

    public function updatedFormPrice($value)
    {
        if (preg_match('/^-?\d+(\.\d+)?$/', $value)) {
            $this->form->price = number_format($value, 2);
        }
    }

    public function removePhoto($index)
    {
        unset($this->form->photos[$index]);
    }
}
