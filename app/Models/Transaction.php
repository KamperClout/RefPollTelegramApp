<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id', 'amount', 'type', 'status', 'description'
    ];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function getFormattedUpdatedAtAttribute()
    {
        $date = $this->updated_at;

        if ($date->isToday()) {
            return 'Сегодня, ' . $date->format('H:i');
        } elseif ($date->isYesterday()) {
            return 'Вчера, ' . $date->format('H:i');
        } else {
            return $date->isoFormat('D MMMM, HH:mm');
        }
    }
}
