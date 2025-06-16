<?php

namespace App\Filament\Resources\AnketaStatisticsResource\Pages;

use App\Filament\Resources\AnketaStatisticsResource;
use App\Filament\Resources\AnketaStatisticsResource\Widgets\AnketaQuestionChart;
use App\Filament\Resources\AnketaStatisticsResource\Widgets\AnketaQuestionWidget;
use App\Filament\Resources\AnketaStatisticsResource\Widgets\AnketaStatusChart;
use Filament\Actions;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\view;
use Filament\Resources\Pages\ViewRecord;
class ViewAnketaStatistics extends ViewRecord
{
    protected static string $resource = AnketaStatisticsResource::class;

    protected function getHeaderWidgets(): array
    {
        $widgets = [];

        // Получаем модель анкеты из текущего записи
        $anketa = $this->getRecord();
        $widgets[] = AnketaStatisticsResource\Widgets\AnketaCompletionsChart::make(['anketa' => $anketa]);

        // Для каждого вопроса создаем соответствующий виджет
        foreach ($anketa->questions as $question) {
                $widgets[] = AnketaStatisticsResource\Widgets\AnketaQuestionChart::make(['question' => $question]);
        }
        $widgets[] = AnketaStatisticsResource\Widgets\AnketaRadioCheckboxChart::class;
        foreach ($anketa->questions as $question){
            $widgets[] = AnketaStatisticsResource\Widgets\AnketaRadioChart::make(['question' => $question]);
        }

        return $widgets;
    }
    protected function getWidgetClassForQuestion($question): ?string
    {
        // Определяем тип виджета в зависимости от типа вопроса
                return AnketaStatisticsResource\Widgets\AnketaRadioCheckboxChart::class;
    }

//    protected function getHeaderWidgets(): array
//    {
//        return [
//            AnketaQuestionChart::class,
//            AnketaStatisticsResource\Widgets\AnketaRadioCheckboxChart::class
//        ];
//    }

    public function getTitle(): string
    {
        return 'Просмотр статистики';
    }

}
