<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;

class TransactionController extends Controller
{
    public function store(Request $request, Wallet $wallet): JsonResponse
    {
        try {
            $validated = $request->validate([
                'type'        => 'required|in:income,expense',
                'amount'      => 'required|numeric|min:0.01',
                'description' => 'nullable|string|max:500',
            ]);

            $transaction = $wallet->transactions()->create($validated);
            $wallet->load('transactions');

            return response()->json([
                'message' => 'Transaction recorded successfully',
                'transaction' => [
                    'id'          => $transaction->id,
                    'type'        => $transaction->type,
                    'amount'      => number_format($transaction->amount, 2),
                    'description' => $transaction->description,
                    'created_at'  => $transaction->created_at,
                ],
                'wallet_balance' => number_format($wallet->balance, 2),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
