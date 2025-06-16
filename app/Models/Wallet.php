<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = ['agent_id', 'balance'];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('created_at', 'DESC');
    }

    public function getEarningsFromFriends(): float
    {
        return $this->transactions()
            ->where('description', 'Доход от приглашенного пользователя')
            ->where('status', 'completed')
            ->sum('amount');
    }

    public function deposit(float $amount, ?string $description = null): Transaction
    {
        return $this->createTransaction($amount, 'deposit', $description);
    }

    public function withdraw(float $amount, ?string $description = null): Transaction
    {
        if ($this->balance < $amount) {
            throw new \Exception('Insufficient funds');
        }

        return $this->createTransaction(-$amount, 'withdrawal', $description);
    }

    protected function createTransaction(float $amount, string $type, ?string $description = null): Transaction
    {
        return $this->transactions()->create([
            'amount' => $amount,
            'type' => $type,
            'status' => 'completed',
            'description' => $description
        ]);
    }
}
