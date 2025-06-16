<?php

namespace App\Filament\Resources\AgentResource\Widgets;

use App\Models\Agent;
use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class AgentActivityChartWidget extends ChartWidget
{
    public ?Agent $record = null;

    protected static ?string $heading = 'Активность за последние 7 дней';

    protected function getData(): array
    {
        $data = Transaction::query()
            ->whereHas('wallet', function ($query) {
                $query->where('agent_id', $this->record->id);
            })
            ->where('created_at', '>=', now()->subDays(7))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Количество транзакций',
                    'data' => $data->pluck('count')->toArray(),
                    'borderColor' => '#10B981',
                ],
            ],
            'labels' => $data->pluck('date')->map(function ($date) {
                return Carbon::parse($date)->format('d.m.Y');
            })->toArray(),
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
