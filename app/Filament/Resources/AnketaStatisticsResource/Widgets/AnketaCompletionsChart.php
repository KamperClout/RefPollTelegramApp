<?php

namespace App\Filament\Resources\AnketaStatisticsResource\Widgets;

use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use App\Models\AnsweredAnketa;

class AnketaCompletionsChart extends ChartWidget
{
    public ?\App\Models\Anketa $anketa = null;
    protected function getData(): array
    {
        $completions = AnsweredAnketa::query()
            ->where('anketa_id', $this->anketa->id)
            ->selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = $completions->pluck('date')->map(fn($date) => Carbon::parse($date)->format('d.m.Y'))->toArray();
        $counts = $completions->pluck('count')->toArray();

        return [
            'labels' => $dates,
            'datasets' => [
                [
                    'label' => 'Количество заполнений',
                    'data' => $counts,
                    'backgroundColor' => '#36A2EB', // Цвет графика
                    'borderColor' => '#9BD0F5', // Цвет границы
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
                'y' => [ // Настраиваем ось Y
                    'ticks' => [
                        'stepSize' => 1, // Устанавливаем шаг 1, чтобы отображать только целые числа
                        'beginAtZero' => true,
                    ],
                ],
            ],
        ];
    }
}
