<?php

namespace App\Filament\Widgets;

use App\Models\AnsweredAnketa;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Widget;
class FilledAnketaWidget extends Widget
{
    protected static string $view = 'filament.widgets.filled-anketa-widget';
    public function getData(): array
    {
        $now = now();
        $today = $now->copy()->startOfDay();
        $sevenDaysAgo = $now->copy()->subDays(7)->startOfDay();
        $query = AnsweredAnketa::query();
        // Если пользователь не админ, фильтруем по его анкетам
        if (auth()->user()->role !== 0) {
            $anketaIds = \App\Models\Anketa::where('user_id', auth()->id())->pluck('id');
            $query->whereIn('anketa_id', $anketaIds);
        }
        $current = (clone $query)
            ->whereBetween('created_at', [$today, $now])
            ->count();

        $previous = (clone $query)
            ->whereBetween('created_at', [$sevenDaysAgo, $today])
            ->count();

        $percent = 0;
        if ($previous > 0) {
            $percent = min(round((($current - $previous) / $previous) * 100, 1), 100);
        } elseif ($current > 0) {
            $percent = 100;
        }
        $direction = $current >= $previous ? 'increase' : 'decrease';

        return [
            'current' => $current,
            'previous' => $previous,
            'percent' => $percent,
            'direction' => $direction,
        ];
    }
}
