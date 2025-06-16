<?php

namespace App\Filament\Resources\AnketaStatisticsResource\Widgets;

use App\Models\Anketa;
use App\Models\AnsweredAnketa;
use Filament\Forms\Components\Select;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Widget;
use function Laravel\Prompts\alert;

class AnketaQuestionChart extends ChartWidget
{
    public $record;
    public $question;
    public ?string $selectedQuestion = null;

    private const MAX_LABEL_LENGTH = 25; // Максимальная длина для меток

    private function formatLabel(string $text): string
    {
        return mb_strlen($text) > self::MAX_LABEL_LENGTH
            ? mb_substr($text, 0, self::MAX_LABEL_LENGTH) . '...'
            : $text;
    }

    protected function getData(): array
    {
        $anketa = $this->record;
        $questions = $anketa->questions;
        $answered = \App\Models\AnsweredAnketa::where('anketa_id', $anketa->id)->get();

        $allVariants = [];

        foreach ($questions as $question) {
            if($question->text == $this->question->text) {
                foreach ($answered as $item) {
                    $answers = is_array($item->answers) ? $item->answers : json_decode($item->answers, true);
                    if (!isset($answers[$question->text])) continue;

                    $answer = $answers[$question->text];

                    // Для чекбоксов ответы могут быть строкой с разделителем ";"
                    if (is_string($answer) && str_contains($answer, ';')) {
                        foreach (explode(';', $answer) as $ans) {
                            $ans = trim($ans);
                            if ($ans !== '') {
                                $formattedAns = $this->formatLabel($ans);
                                $allVariants[$formattedAns] = ($allVariants[$formattedAns] ?? 0) + 1;
                            }
                        }
                    } else {
                        $ans = is_array($answer) ? implode(', ', $answer) : $answer;
                        $formattedAns = $this->formatLabel($ans);
                        $allVariants[$formattedAns] = ($allVariants[$formattedAns] ?? 0) + 1;
                    }
                }
            }
        }

        // Сортируем по убыванию
        arsort($allVariants);

        // Оставляем топ-10, остальные в "Прочее"
        $top = array_slice($allVariants, 0, 10, true);
        if (count($allVariants) > 10) {
            $top['Прочее'] = array_sum(array_slice($allVariants, 10));
        }

        return [
            'datasets' => [
                [
                    'label' => $this->formatLabel($this->question->text),
                    'data' => array_values($top),
                ],
            ],
            'labels' => array_keys($top),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [ // Настраиваем ось Y
                    'ticks' => [
                        'stepSize' => 1, // Устанавливаем шаг 1, чтобы отображать только целые числа

                    ],
                ],
                'x' => [
                    'ticks' => [
                        'font' => [ // Добавляем конфигурацию шрифта для оси X
                            'size' => 10, // Уменьшаем размер шрифта (например, до 11px)
                        ],
                    ],
                ],
            ],
        ];
    }
}
