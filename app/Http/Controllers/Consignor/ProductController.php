<?php

namespace App\Http\Controllers\Consignor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('consignor.product.index');
    }

    public function create(): View
    {
        return view('consignor.product.create');
    }

    public function edit(Product $product): View
    {
        return view('consignor.product.edit', compact('product'));
    }
}
