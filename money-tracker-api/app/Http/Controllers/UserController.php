<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create($validated);
              // Generate API token
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'message' => 'User created successfully',
                'user' => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                    'token' => $token,
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(User $user): JsonResponse
    {
        try {
            $user->load('wallets.transactions');

            $wallets = $user->wallets->map(fn($wallet) => [
                'id'      => $wallet->id,
                'name'    => $wallet->name,
                'balance' => number_format($wallet->balance, 2),
            ]);

            return response()->json([
                'user' => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                ],
                'wallets'       => $wallets,
                'total_balance' => number_format($user->total_balance, 2),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
