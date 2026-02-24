<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    //
    protected $fillable = ['name', 'user_id'];
    /**
     * A wallet belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A wallet has many transactions.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Calculate the wallet's current balance.
     * Income adds to balance; expense subtracts from balance.
     */
    public function getBalanceAttribute(): float
    {
        $income  = $this->transactions->where('type', 'income')->sum('amount');
        $expense = $this->transactions->where('type', 'expense')->sum('amount');

        return $income - $expense;
    }
}
