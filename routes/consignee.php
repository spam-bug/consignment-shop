<?php

use App\Http\Controllers\Consignee\DashboardController;
use App\Livewire\Products\Search;
use Illuminate\Support\Facades\Route;


Route::get('/', DashboardController::class)->name('dashboard');
Route::get('/dashboard', DashboardController::class);

Route::prefix('products')->group(function () {
    Route::get('/search', Search::class)->name('products.search');
});