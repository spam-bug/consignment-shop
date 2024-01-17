<?php

use App\Http\Controllers\Consignee\DashboardController;
use App\Livewire\Consignee\Products\LookUp;
use App\Livewire\Consignee\Products\LookUpPreview;
use App\Livewire\Consignee\Products\Shortlists;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;


Route::get('/', DashboardController::class)->name('dashboard');
Route::get('/dashboard', DashboardController::class);

Route::prefix('products')->group(function () {
    Route::prefix('look-up')->group(function () {
        Route::get('/', LookUp::class)->name('products.look');
        Route::get('/{product:slug}', LookUpPreview::class)->name('products.look.preview');
    });

    Route::get('shortlist', Shortlists::class)->name('products.shortlists');
});

Route::get('/contracts', function () {
    return Pdf::loadView('pdf.contract')->stream('contract.pdf');
});