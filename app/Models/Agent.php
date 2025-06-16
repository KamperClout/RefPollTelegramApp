<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Agent extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'phone', 'region', 'is_qualified', 'is_banned'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
    protected $fillable =
        [
            'tg_id',
            'name',
            'phone',
            'region',
            'is_qualified',
            'is_banned',
        ];

    public function invites()
    {
        return $this->hasMany(Invite::class, "inviter_id");
    }

    public function getInviter()
    {
        $invite = $this->hasMany(Invite::class, "invited_id")->first();
        if ($invite)
        {
            return $invite->inviter;
        }
        return null;
    }

    public function invitedAgents()
    {
        $invites = $this->hasMany(Invite::class, "inviter_id")->get();
        $invited = [];
        foreach ($invites as $invite)
        {
            $invited[] = $invite->invited()->first();
        }
        return $invited;
    }

    public function deepInvitedAgents()
    {
        $invites = $this->hasMany(Invite::class, "inviter_id")->get();
        $invited = [];
        foreach ($invites as $invite)
        {
            $invitedAgent = $invite->invited()->first();
            foreach ($invitedAgent->invitedAgents() as $agent)
            {
                $invited[] = $agent;
            }
            $invited[] = $invitedAgent;
        }
        return $invited;
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, "agent_id");
    }

    public function answeredCount()
    {
        $anketas = $this->hasMany(AnsweredAnketa::class)->where('status', "Одобрено")->get();
        return count($anketas);
    }

    public function getBalance()
    {
        return $this->wallet->balance;
    }
}
