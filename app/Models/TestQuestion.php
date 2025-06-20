<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'text'
    ];

    public function answers()
    {
        return $this->hasMany(TestAnswer::class);
    }

    public function anketa()
    {
        return $this->belongsTo(Test::class);
    }
}
