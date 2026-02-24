<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;

class WalletController extends Controller
{
    public function store(Request $request, User $user): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $wallet = $user->wallets()->create($validated);

            return response()->json([
                'message' => 'Wallet created successfully',
                'wallet' => [
                    'id'      => $wallet->id,
                    'name'    => $wallet->name,
                    'balance' => '0.00',
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Wallet $wallet): JsonResponse
    {
        try {
            $wallet->load('transactions');

            $transactions = $wallet->transactions->map(fn($trans) => [
                'id'          => $trans->id,
                'type'        => $trans->type,
                'amount'      => number_format($trans->amount, 2),
                'description' => $trans->description,
                'created_at'  => $trans->created_at,
            ]);

            return response()->json([
                'wallet' => [
                    'id'       => $wallet->id,
                    'name'     => $wallet->name,
                    'balance'  => number_format($wallet->balance, 2),
                    'transactions' => $transactions,
                ],
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
