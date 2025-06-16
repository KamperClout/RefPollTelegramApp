<?php

namespace App\Providers;

use App\Models\Agent;
use App\Models\AnsweredAnketa;
use App\Models\Transaction;
use App\Observers\AgentObserver;
use App\Observers\AnsweredAnketaObserver;
use App\Observers\TransactionObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Transaction::observe(TransactionObserver::class);
        Agent::observe(AgentObserver::class);
        AnsweredAnketa::observe(AnsweredAnketaObserver::class);
    }
}
