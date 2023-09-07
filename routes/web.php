<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Mail;


Route::get('/', function () {
    return view('welcome');
});

//Rotas de vendedores

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('seller/create', [SellerController::class, 'create'])->middleware(['auth'])->name('create');
Route::post('seller/store', [SellerController::class, 'store'])->middleware(['auth'])->name('store');

Route::get('/sellers/{id}/edit', [SellerController::class, 'edit'])->middleware(['auth'])->name('seller.edit');
Route::patch('/sellers/{id}', [SellerController::class, 'update'])->middleware(['auth'])->name('seller.update');
Route::delete('/sellers/{id}', [SellerController::class, 'destroy'])->middleware(['auth'])->name('seller.destroy');

//Rota de vendas

Route::post('/sale/store', [SaleController::class, 'store'])->middleware(['auth'])->name('sales.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
