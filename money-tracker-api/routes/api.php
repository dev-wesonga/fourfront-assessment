<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;


Route::post('/users', [UserController::class, 'store']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // User routes
    Route::get('/users/{user}', [UserController::class, 'show']);

    // Wallet routes
    Route::post('/users/{user}/wallets', [WalletController::class, 'store']);
    Route::get('/wallets/{wallet}', [WalletController::class, 'show']);

    // Transaction routes
    Route::post('/wallets/{wallet}/transactions', [TransactionController::class, 'store']);
});
