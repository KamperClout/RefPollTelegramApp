<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\AnsweredAnketa;
use Illuminate\Support\Carbon;
class TotalAnsweredWidget extends ChartWidget
{
    protected static ?string $heading = 'Всего заполнено по месяцам';

    protected function getData(): array
    {
        $months = collect(range(0, 11))->map(function ($i) {
            return now()->subMonths(11 - $i)->format('Y-m');
        });

        $query = AnsweredAnketa::query();

        // Если пользователь не админ, фильтруем по его анкетам
        if (auth()->user()->role !== 0) {
            $anketaIds = \App\Models\Anketa::where('user_id', auth()->id())->pluck('id');
            $query->whereIn('anketa_id', $anketaIds);
        }

        $data = (clone $query)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $labels = $months->map(function ($month) {
            return Carbon::createFromFormat('Y-m', $month)->translatedFormat('F Y');
        })->toArray();

        $values = $months->map(fn($month) => $data[$month] ?? 0)->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Заполнено анкет',
                    'data' => $values,
                    'borderColor' => 'rgb(34,197,94)', // зелёный
                    'backgroundColor' => 'rgba(34,197,94,0.15)',
                    'tension' => 0.4,
                    'fill' => true,
                ],
            ],
        ];
    }


    protected function getType(): string
    {
        return 'line';
    }
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}

