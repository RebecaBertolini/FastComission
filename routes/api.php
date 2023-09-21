<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SellerController;



Route::middleware('api')->group(function () {
    Route::get('/sellers', [SellerController::class, 'index']);
    Route::post('/sellers', [SellerController::class, 'store']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
