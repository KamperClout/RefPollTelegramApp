<?php

namespace App\Filament\Resources\AnketaStatisticsResource\Widgets;

use App\Models\AnsweredAnketa;
use Filament\Widgets\ChartWidget;

class AnketaRadioCheckboxChart extends ChartWidget
{
    public $record;
    public $question;

    private const MAX_QUESTION_LENGTH = 20; // Уменьшили длину вопроса
    private const MAX_ANSWER_LENGTH = 15;   // Добавили ограничение для ответа

    protected function getData(): array
    {
        $anketa = $this->record;
        $questions = $anketa->questions->whereIn('type', ['checkbox']);
        $answered = AnsweredAnketa::where('anketa_id', $anketa->id)->get();

        $allVariants = [];

        foreach ($questions as $question) {
            foreach ($answered as $item) {
                $answers = is_array($item->answers) ? $item->answers : json_decode($item->answers, true);
                if (!isset($answers[$question->text])) continue;

                $answer = $answers[$question->text];
                if ($question->type === 'checkbox' && is_string($answer) && str_contains($answer, ';')) {
                    foreach (explode(';', $answer) as $ans) {
                        $ans = trim($ans);
                        if ($ans !== '') {
                            $shortenedAnswer = mb_strlen($ans) > self::MAX_ANSWER_LENGTH
                                ? mb_substr($ans, 0, self::MAX_ANSWER_LENGTH) . '...'
                                : $ans;
                            $label = $shortenedAnswer;
                            $allVariants[$label] = ($allVariants[$label] ?? 0) + 1;
                        }
                    }
                } else {
                    $ans = is_array($answer) ? implode(', ', $answer) : $answer;
                    $shortenedAnswer = mb_strlen($ans) > self::MAX_ANSWER_LENGTH
                        ? mb_substr($ans, 0, self::MAX_ANSWER_LENGTH) . '...'
                        : $ans;
                    $label = $shortenedAnswer;
                    $allVariants[$label] = ($allVariants[$label] ?? 0) + 1;
                }
            }
        }

        arsort($allVariants);

        $top = array_slice($allVariants, 0, 10, true);
        if (count($allVariants) > 10) {
            $top['Прочее'] = array_sum(array_slice($allVariants, 10));
        }

        return [
            'datasets' => [
                [
                    'label' => 'Количество',
                    'data' => array_values($top),
                ],
            ],
            'labels' => array_keys($top),
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

                    ],
                ],
                'x' => [
                    'ticks' => [
                        'font' => [ // Добавляем конфигурацию шрифта для оси X
                            'size' => 11, // Уменьшаем размер шрифта (например, до 11px)
                        ],
                    ],
                ],
            ],
        ];
    }
}
