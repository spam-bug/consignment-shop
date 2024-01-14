<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', DashboardController::class)->name('admin.dashboard');

Route::get('/users', [UserController::class, 'index'])->name('admin.users');
Route::post('/users/{user}/approve', [UserController::class, 'approve'])->name('admin.users.approve');

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
    Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/{category:slug}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::patch('/{category:slug}/update', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/{category:slug}/delete', [CategoryController::class, 'delete'])->name('admin.categories.delete');
});