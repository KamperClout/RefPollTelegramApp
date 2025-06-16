<?php

namespace App\Filament\Resources\AgentResource\Widgets;

use App\Models\Agent;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AgentStatsWidget extends BaseWidget
{
    public ?Agent $record = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Текущий баланс', number_format($this->record->getBalance(), 2) . ' ₽')
                ->description('Доступные средства')
                ->descriptionIcon('heroicon-m-wallet')
                ->color('success'),

            Stat::make('Заполнено анкет', $this->record->answeredCount())
                ->description('Всего заполненных анкет')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Статус', $this->record->is_qualified ? 'Квалифицирован' : 'Не квалифицирован')
                ->description('Текущий статус агента')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color($this->record->is_qualified ? 'success' : 'danger'),
        ];
    }
}
