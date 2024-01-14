<?php

use App\Http\Controllers\Consignor\DashboardController;
use App\Http\Controllers\Consignor\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', DashboardController::class)->name('consignor.dashboard');

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('consignor.products');
    Route::get('/create', [ProductController::class, 'create'])->name('consignor.products.create');
    Route::get('/{product:slug}/edit', [ProductController::class, 'edit'])->name('consignor.products.edit');
});