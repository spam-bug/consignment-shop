<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'alpha_spaces']
        ];

        $rules['name'][] = match($this->method()) {
            "POST" => Rule::unique('categories', 'name'),
            "PUT", "PATCH" => Rule:: unique('categories', 'name')->ignore($this->id),
        };

        return $rules;
    }

    public function storeCategory(): Category
    {
        return Category::create(
            $this->validationData()
        );
    }

    public function updateCategory(Category $category): Category
    {
        $category->update(
            $this->validationData()
        );

        return $category;
    }
}
