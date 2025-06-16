<?php

namespace App\Observers;

use App\Models\AnsweredAnketa;

class AnsweredAnketaObserver
{
    /**
     * Handle the AnsweredAnketa "created" event.
     */
    public function created(AnsweredAnketa $answeredAnketa): void
    {
        //
    }

    /**
     * Handle the AnsweredAnketa "updated" event.
     */
    public function updated(AnsweredAnketa $answeredAnketa): void
    {
        if ($answeredAnketa->isDirty('status') && $answeredAnketa->status === 'Одобрено') {
            $agent = $answeredAnketa->agent;
            $anketa = $answeredAnketa->anketa;
            $price = $anketa->price;
            $wallet = $agent->wallet;
            $wallet->deposit($price, "Анкета " . $anketa->name);
            //Зачисление приглашающим
            $inviter = $agent->getInviter();
            if($inviter)
            {
                $inviter->wallet->deposit($price * 0.1, "Доход от приглашенного пользователя");

                $inviterInv = $inviter->getInviter();
                if($inviterInv)
                {
                    $inviterInv->wallet->deposit($price * 0.05, "Доход от приглашенного пользователя");
                }
            }
        }
    }

    /**
     * Handle the AnsweredAnketa "deleted" event.
     */
    public function deleted(AnsweredAnketa $answeredAnketa): void
    {
        //
    }

    /**
     * Handle the AnsweredAnketa "restored" event.
     */
    public function restored(AnsweredAnketa $answeredAnketa): void
    {
        //
    }

    /**
     * Handle the AnsweredAnketa "force deleted" event.
     */
    public function forceDeleted(AnsweredAnketa $answeredAnketa): void
    {
        //
    }
}
