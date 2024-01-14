<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\ActivationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\TwoFactorAuthenticationController;
use App\Http\Controllers\Consignor\DashboardController as ConsignorDashboardController;
use App\Http\Controllers\Consignor\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');

# Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('auth.login');
    Route::post('/login', [AuthenticatedSessionController::class,'store']);

    Route::get('/register', [RegistrationController::class, 'create'])->name('auth.register');
    Route::post('/register', [RegistrationController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/activation', ActivationController::class)->middleware('account.inactive')->name('auth.activation');
    
    Route::middleware('two-factor.verified')->group(function () {
        Route::get('/two-factor', [TwoFactorAuthenticationController::class, 'create'])->name('auth.two-factor');
        Route::post('/two-factor', [TwoFactorAuthenticationController::class, 'verify'])->name('auth.two-factor.verify');
        Route::get('/two-factor/send', [TwoFactorAuthenticationController::class, 'send'])->name('auth.two-factor.send');
    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('auth.logout');

    Route::prefix('email')->group(function () {
        Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
        Route::post('verification-notification', [EmailVerificationController::class, 'resend'])->name('verification.send');
    });
});
