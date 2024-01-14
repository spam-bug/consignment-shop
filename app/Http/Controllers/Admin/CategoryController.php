<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AlertType;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.category.index', [
            'categories' => Category::paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $request->storeCategory();

        return redirect()->route('admin.categories')->withAlert(
            type: AlertType::Success,
            message: __('alert.category.create')
        );
    }

    public function edit(Category $category): View
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Category $category, CategoryRequest $request): RedirectResponse
    {
        $request->updateCategory($category);

        return redirect()->route('admin.categories')->withAlert(
            type: AlertType::Success,
            message: __('alert.category.update')
        );
    }

    public function delete(Category $category)
    {
        foreach ($category->products as $product) {
            $product->category_id = null;
            $product->save();
        }

        $category->delete();

        return redirect()->route('admin.categories')->withAlert(
            type: AlertType::Success,
            message: __('alert.category.delete')
        );
    }
}
