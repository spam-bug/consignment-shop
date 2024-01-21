<?php

use App\Http\Controllers\Consignor\ContractController;
use App\Http\Controllers\Consignor\DashboardController;
use App\Http\Controllers\Consignor\OrderController;
use App\Http\Controllers\Consignor\ProductController;
use App\Http\Controllers\Consignor\ReportController;
use App\Http\Controllers\Consignor\TransactionController;
use App\Livewire\Consignor\Inbox;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', DashboardController::class)->name('dashboard');

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/{product:slug}/edit', [ProductController::class, 'edit'])->name('products.edit');
});

Route::get('/orders', [OrderController::class, 'index'])->name('orders');
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');

Route::prefix('reports')->group(function () {
    Route::post('/transactions', [ReportController::class, 'transactions'])->name('reports.transactions');
    Route::post('/products', [ReportController::class, 'products'])->name('reports.products');
});

Route::prefix('contracts')->group(function () {
    Route::get('/', [ContractController::class, 'index'])->name('contracts');
});

Route::get('/inbox', Inbox::class)->name('inbox');