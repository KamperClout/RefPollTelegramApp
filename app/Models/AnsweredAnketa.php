<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnsweredAnketa extends Model
{
    use HasFactory;

    protected $fillable = [
        'answers',
        'status',
        'anketa_id',
        'agent_id',
        'is_referral'
    ];

    protected $casts = [
        'answers' => 'json',
        'is_referral' => 'boolean'
    ];

    public function anketa()
    {
        return $this->belongsTo(Anketa::class, 'anketa_id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
