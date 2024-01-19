<?php

use App\Http\Controllers\Consignor\ContractController;
use App\Http\Controllers\Consignor\DashboardController;
use App\Http\Controllers\Consignor\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/{product:slug}/edit', [ProductController::class, 'edit'])->name('products.edit');
});

Route::prefix('contracts')->group(function () {
    Route::get('/', [ContractController::class, 'index'])->name('contracts');
});