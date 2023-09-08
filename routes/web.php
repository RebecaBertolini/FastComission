<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Mail;

//User Seller Route

Route::get('/', [HomeController::class, 'index'])->middleware(['auth'])->name('home');

//Seller Admin

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'admin'])->name('dashboard');

//Seller Routes

Route::get('seller/create', [SellerController::class, 'create'])->middleware(['auth', 'admin'])->name('create');
Route::post('seller/store', [SellerController::class, 'store'])->middleware(['auth', 'admin'])->name('store');

Route::get('/sellers/{id}/edit', [SellerController::class, 'edit'])->middleware(['auth', 'admin'])->name('seller.edit');
Route::put('/sellers/{id}', [SellerController::class, 'update'])->middleware(['auth', 'admin'])->name('seller.update');
Route::delete('/sellers/{id}', [SellerController::class, 'destroy'])->middleware(['auth', 'admin'])->name('seller.destroy');

//Sale Routes

Route::post('/sale/store', [SaleController::class, 'store'])->middleware(['auth'])->name('sales.store');
Route::delete('/sale/{id}/delete', [SaleController::class, 'destroy'])->middleware(['auth'])->name('sales.destroy');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
