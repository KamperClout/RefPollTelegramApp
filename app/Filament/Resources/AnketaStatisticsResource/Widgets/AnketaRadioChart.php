<?php

namespace App\Filament\Resources\AnketaStatisticsResource\Widgets;

use App\Models\AnsweredAnketa;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Js;

class AnketaRadioChart extends ChartWidget
{
    public $record;
    public $question;
    public ?string $selectedQuestion = null;
    private const MAX_LABEL_LENGTH = 45;
    private const MAX_VARIANTS = 3;

    private function formatLabel(string $text): string
    {
        return mb_strlen($text) > self::MAX_LABEL_LENGTH
            ? mb_substr($text, 0, self::MAX_LABEL_LENGTH) . '...'
            : $text;
    }

    public function getHeading(): ?string
    {
        return $this->question ? $this->formatLabel($this->question->text) : null;
    }

    protected function getData(): array
    {
        $anketa = $this->record;
        $question = $this->question;

        if (!$question) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }
        $answered = AnsweredAnketa::where('anketa_id', $anketa->id)->get();
        $allVariants = [];

        foreach ($answered as $item) {
            $answers = is_array($item->answers) ? $item->answers : json_decode($item->answers, true);
            if (!isset($answers[$question->text])) continue;

            $answer = $answers[$question->text];

            if (is_string($answer) && $answer !== '') {
                $formattedAns = $this->formatLabel($answer);
                $allVariants[$formattedAns] = ($allVariants[$formattedAns] ?? 0) + 1;
            }
        }

        arsort($allVariants);

        // Берем только первые MAX_VARIANTS вариантов
        $variants = array_slice($allVariants, 0, self::MAX_VARIANTS, true);

        // Если вариантов больше MAX_VARIANTS, добавляем "Прочее"
        if (count($allVariants) > self::MAX_VARIANTS) {
            $variants['Прочее'] = array_sum(array_slice($allVariants, self::MAX_VARIANTS));
        }

        $total = array_sum($variants);
        $labels = [];
        foreach ($variants as $label => $count) {
            $percentage = $total > 0 ? round(($count / $total) * 100) : 0;
            $labels[] = "{$label} ({$percentage}%)";
        }

        return [
            'datasets' => [
                [
                    'data' => array_values($variants),
                    'backgroundColor' => ['#10B981', '#3B82F6', '#F59E0B', '#EF4444'],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => $labels,
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
                    'labels' => [
                        'boxWidth' => 12,
                        'padding' => 0,
                        'font' => [
                            'size' => 14
                        ]
                    ]
                ],
                'tooltip' => [
                    'enabled' => true,
                    'mode' => 'index',
                    'intersect' => false,
                    'callbacks' => [
                        'label' => Js::from('function(context) {
                            let label = context.label || "";
                            let value = context.raw || 0;
                            return `${label}: ${value} анкет`;
                        }')
                    ]
                ],
                'datalabels' => [
                    'display' => true,
                    'color' => '#fff',
                    'font' => [
                        'weight' => 'bold',
                        'size' => 16
                    ],
                    'formatter' => Js::from('function(value, context) {
                        let total = context.dataset.data.reduce((a, b) => a + b, 0);
                        let percentage = Math.round((value / total) * 100);
                        return percentage + "%";
                    }')
                ]
            ],
            'cutout' => '0%',
            'radius' => '60%',
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
                    'top' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'right' => 0,
                ]
            ]
        ];
    }

    protected function getFooter(): ?string
    {
        return null;
    }
}
