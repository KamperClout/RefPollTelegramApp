<?php

namespace App\Filament\Widgets;

use App\Models\AnsweredAnketa;
use Filament\Widgets\Widget;

class NewClientsWidget extends Widget
{
    protected static string $view = 'filament.widgets.new-clients-widget';

    public function getData(): array
    {
        $now = now();
        $weekAgo = $now->copy()->subWeek();
        $twoWeeksAgo = $now->copy()->subWeeks(2);

        $query = AnsweredAnketa::where('status', 'Одобрено');
        // Если пользователь не админ, фильтруем по его анкетам
        if (auth()->user()->role !== 0) {
            $anketaIds = \App\Models\Anketa::where('user_id', auth()->id())->pluck('id');
            $query->whereIn('anketa_id', $anketaIds);
        }
        $current = (clone $query)
            ->whereBetween('created_at', [$weekAgo, $now])
            ->count();

        $previous = (clone $query)
            ->whereBetween('created_at', [$twoWeeksAgo, $weekAgo])
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
            'percent' => $percent,
            'direction' => $direction,
        ];
    }

}
