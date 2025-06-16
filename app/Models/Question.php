<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'type'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function anketa()
    {
        return $this->belongsTo(Anketa::class);
    }
}
