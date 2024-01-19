<?php

namespace App\Livewire\Consignee\Products;

use App\Enums\ContractStatus;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.consignee'), Title('Orderable')]
class OrderableProducts extends Component
{
    use WithPagination;

    public Collection $categories;
    public string $category = '';
    public string $price = '';
    public string $search = '';

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.consignee.products.orderable-products', [
            'products' => Product::whereLike(['category.slug', 'name'], $this->search)
            ->whereHas('contracts', function ($query) {
                $query->where('consignee_id', Auth::user()->consignee->id)
                ->where('status', ContractStatus::Approve);
            })
                ->when($this->category, function ($query, $category) {
                    $query->whereHas('category', function ($query) use ($category) {
                        $query->where('slug', $category);
                    });
                })
            ->when($this->price, function ($query) {
                $query->orderBy('price', $this->price);
            })
            ->paginate(10),
        ]);
    }
}
