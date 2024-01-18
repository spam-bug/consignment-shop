<?php

use App\Http\Controllers\Consignee\DashboardController;
use App\Livewire\Consignee\Products\LookUp;
use App\Livewire\Consignee\Products\LookUpPreview;
use App\Livewire\Consignee\Products\Shortlists;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/contracts', function (Request $request) {
    $username = $request->get('username');

    $consignee = Auth::user()->consignee;

    $shortlists = $consignee->shortlists()->with('product.consignor')->get();

    $groupedShortlists = $shortlists->groupBy(function ($item) {
        return optional($item->product->consignor->user)->username;
    });

    $shortlists = $groupedShortlists[$username];

    return Pdf::loadView('pdf.contract', [
        'shortlists' => $shortlists,
        'consignor' => User::where('username', $username)->first()->consignor,
    ])->setPaper('legal')->stream('contract.pdf');
})->name('contract');