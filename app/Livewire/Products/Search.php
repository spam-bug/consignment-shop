<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Consignor;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.consignee'), Title('Products')]
class Search extends Component
{
    use WithPagination;

    public string $search = '';

    public Collection $categories;
    public string $category = '';

    public string $prices = '';

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        # TODO: Modify products so that the product that was already in the contract will not be listed.
        return view('livewire.products.search', [
            'products' => Product::whereLike(['category.name', 'name'], $this->search)
            ->when($this->category, function ($query) {
                return $query->whereHas('category', function ($query) {
                    $query->where('slug', $this->category);
                });
            })
            ->paginate(10),
        ]);
    }
}
