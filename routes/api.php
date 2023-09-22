<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\Auth\AuthController;

Route::post('/login', [AuthController::class, 'auth'])->middleware('api');

Route::middleware('api', 'auth:sanctum')->group(function () {

    Route::get('/sellers', [SellerController::class, 'index']);
    Route::post('/sellers', [SellerController::class, 'store']);
    Route::put('/sellers/{id}', [SellerController::class, 'update']);
    Route::delete('/sellers/{id}', [SellerController::class, 'destroy']);
});
