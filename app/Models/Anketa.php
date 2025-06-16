<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Anketa extends Model
{
    use HasFactory,LogsActivity;
    //use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'is_closed',
        'user_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'price',
                'is_closed',
                'user_id'
            ])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                return match($eventName) {
                    'created' => 'Создана новая анкета',
                    'updated' => 'Анкета обновлена',
                    'deleted' => 'Анкета удалена',
                    default => $eventName
                };
            });
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function answeredAnketas()
    {
        return $this->hasMany(AnsweredAnketa::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
