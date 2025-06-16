<?php

namespace App\Filament\Resources\AgentResource\Widgets;

use App\Models\Agent;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class AgentAnketaStatsWidget extends ChartWidget
{
    public ?Agent $record = null;

    protected static ?string $heading = 'Статистика заполненных анкет';

    protected function getData(): array
    {
        $totalAnketas = DB::table('answered_anketas')
            ->where('agent_id', $this->record->id)
            ->count();

        $invitedAnketas = DB::table('answered_anketas')
            ->whereIn('agent_id', function($query) {
                $query->select('invited_id')
                    ->from('invites')
                    ->where('inviter_id', $this->record->id);
            })
            ->count();

        $total = $totalAnketas + $invitedAnketas;
        $ownPercentage = $total > 0 ? round(($totalAnketas / $total) * 100) : 0;
        $invitedPercentage = $total > 0 ? round(($invitedAnketas / $total) * 100) : 0;

        return [
            'datasets' => [
                [
                    'data' => [$totalAnketas, $invitedAnketas],
                    'backgroundColor' => ['#10B981', '#3B82F6'],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => [
                "Заполненные анкеты ({$ownPercentage}%)",
                "Анкеты приглашенных ({$invitedPercentage}%)"
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) {
                            let label = context.label || "";
                            let value = context.raw || 0;
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} анкет`;
                        }'
                    ]
                ],
                'datalabels' => [
                    'display' => true,
                    'color' => '#fff',
                    'font' => [
                        'weight' => 'bold',
                        'size' => 14
                    ],
                    'formatter' => 'function(value, context) {
                        let total = context.dataset.data.reduce((a, b) => a + b, 0);
                        let percentage = Math.round((value / total) * 100);
                        return percentage + "%";
                    }'
                ]
            ],
            'cutout' => '0%',
            'radius' => '70%',
            'scales' => [
                'x' => [
                    'display' => false
                ],
                'y' => [
                    'display' => false
                ]
            ],
            'maintainAspectRatio' => false,
            'responsive' => true,
            'layout' => [
                'padding' => [
                    'top' => 10,
                    'bottom' => 10,
                    'left' => 10,
                    'right' => 10,
                ]
            ]
        ];
    }
}
