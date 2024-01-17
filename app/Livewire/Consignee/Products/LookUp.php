<?php

namespace App\Livewire\Consignee\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.consignee'), Title('Products')]
class LookUp extends Component
{
    use WithPagination;

    public Collection $categories;
    public string $category = '';

    public string $search = '';

    public function mount(): void
    {
        $this->categories = Category::all();
    }

    public function render()
    {
          return view('livewire.consignee.products.look-up', [
            'products' => Product::whereLike(['name', 'category.name'], $this->search)
                ->when($this->category, function ($query, $category) {
                    $query->whereHas('category', function ($query) use ($category) {
                        $query->where('slug', $category);
                    });
                })
                ->whereDoesntHave('shortlists', function ($query) {
                    $query->where('consignee_id', Auth::user()->consignee->id);
                })
                ->paginate(10)
        ]);
    }
}
