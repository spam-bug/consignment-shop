<?php

use App\Http\Controllers\Consignee\ContractController;
use App\Http\Controllers\Consignee\DashboardController;
use App\Http\Controllers\Consignee\OrderController;
use App\Http\Controllers\Consignee\ReportController;
use App\Livewire\Consignee\Checkout;
use App\Livewire\Consignee\Inbox;
use App\Livewire\Consignee\MyProduct;
use App\Livewire\Consignee\Products\LookUp;
use App\Livewire\Consignee\Products\LookUpPreview;
use App\Livewire\Consignee\Products\OrderableProductPreview;
use App\Livewire\Consignee\Products\OrderableProducts;
use App\Livewire\Consignee\Products\Shortlists;
use App\Livewire\Consignee\ShoppingCart;
use Illuminate\Support\Facades\Route;


Route::get('/', DashboardController::class)->name('dashboard');
Route::get('/dashboard', DashboardController::class);

Route::prefix('products')->group(function () {
    Route::prefix('look-up')->group(function () {
        Route::get('/', LookUp::class)->name('products.look');
        Route::get('/{product:slug}', LookUpPreview::class)->name('products.look.preview');
    });

    Route::get('/my-product', MyProduct::class)->name('products.my-product');

    Route::get('shortlist', Shortlists::class)->name('products.shortlists');
    Route::prefix('orderable')->group(function () {
        Route::get('/', OrderableProducts::class)->name('products.orderable');
        Route::get('/{product:slug}', OrderableProductPreview::class)->name('products.orderable.preview');
    });
});

Route::prefix('reports')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('reports');
    Route::post('products', [ReportController::class, 'products'])->name('reports.product');
});

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders');
});

Route::get('/cart', ShoppingCart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout');

Route::prefix('contracts')->group(function () {
    Route::get('/', [ContractController::class, 'index'])->name('contracts');
});

Route::get('/inbox', Inbox::class)->name('inbox');