<?php

namespace App\Livewire\Forms;

use App\Enums\ProductStatus;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $product = null;

    public $category = '';
    public $name = '';
    public $description = '';
    public $sku = '';
    public $stock = '';
    public $stock_threshold = '';
    public $price = '';
    public $photos = [];

    public function createProduct(): Product
    {
        $this->validate();

        $category = Category::findBySlug($this->category);

        $product = Auth::user()->consignor->products()->create([
            ...$this->except('photos'),
            'category_id' => $category->id,
            'status' => ProductStatus::Listed,
            'photos' => $this->storePhotos($this->photos),
        ]);

        $product->stockRecords()->create([
            'quantity' => $this->stock,
            'remark' => 'initial stock',
        ]);

        return $product;
    }

    public function updateProduct()
    {
        $this->validate();

        $category = Category::findBySlug($this->category);

        $this->product->update([
            ...$this->except('photos'),
            'category_id' => $category->id,
            'photos' => $this->storePhotos($this->photos),
        ]);

        return $this->product;
    }

    public function set(Product $product)
    {
        $this->product = $product;

        $this->fill($product->toArray());
        $this->category = $product->category->slug;
    }

    public function rules()
    {
        $rules = [
            'category' => ['required'],
            'name' => ['required', 'alpha_spaces'],
            'description' => ['required'],
            'sku' => ['required'],
            'stock' => ['required', 'integer'],
            'stock_threshold' => ['required', 'integer'],
            'price' => ['required', 'currency'],
            'photos' => ['required', 'min:1'],
        ];

        $rules['sku'][] = is_null($this->product)
            ? Rule::unique('products', 'sku')
            : Rule::unique('products', 'sku')->ignoreModel($this->product);

        return $rules;
    }

    private function storePhotos(array $photos): array
    {
        return array_map(fn ($photo) => ($photo instanceof TemporaryUploadedFile) ? $photo->store('photos') : $photo, $photos);
    }
}
