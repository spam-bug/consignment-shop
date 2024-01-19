<?php

use App\Http\Controllers\Consignee\ContractController;
use App\Http\Controllers\Consignee\DashboardController;
use App\Livewire\Consignee\Products\LookUp;
use App\Livewire\Consignee\Products\LookUpPreview;
use App\Livewire\Consignee\Products\OrderableProductPreview;
use App\Livewire\Consignee\Products\OrderableProducts;
use App\Livewire\Consignee\Products\Shortlists;
use Illuminate\Support\Facades\Route;


Route::get('/', DashboardController::class)->name('dashboard');
Route::get('/dashboard', DashboardController::class);

Route::prefix('products')->group(function () {
    Route::prefix('look-up')->group(function () {
        Route::get('/', LookUp::class)->name('products.look');
        Route::get('/{product:slug}', LookUpPreview::class)->name('products.look.preview');
    });

    Route::get('shortlist', Shortlists::class)->name('products.shortlists');
    Route::prefix('orderable')->group(function () {
        Route::get('/', OrderableProducts::class)->name('products.orderable');
        Route::get('/{product:slug}', OrderableProductPreview::class)->name('products.orderable.preview');
    });
});

Route::prefix('contracts')->group(function () {
    Route::get('/', [ContractController::class, 'index'])->name('contracts');
});
