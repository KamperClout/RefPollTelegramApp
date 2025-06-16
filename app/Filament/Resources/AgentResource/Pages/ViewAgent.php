<?php

namespace App\Filament\Resources\AgentResource\Pages;

use App\Filament\Resources\AgentResource;
use App\Filament\Resources\AgentResource\Widgets\AgentActivityChartWidget;
use App\Filament\Resources\AgentResource\Widgets\AgentRecentActivityWidget;
use App\Filament\Resources\AgentResource\Widgets\AgentStatsWidget;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
class ViewAgent extends ViewRecord
{
    protected static string $resource = AgentResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Информация об агенте')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Имя агента'),
                        TextEntry::make('is_banned')
                            ->label('Блокировка')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'danger' : 'success')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Заблокирован' : 'Не заблокирован'),
                        TextEntry::make('phone')
                            ->label('Телефон'),
                        TextEntry::make('tg_id')
                            ->label("Telegram ID"),
                        TextEntry::make('created_at')
                            ->label('Дата регистрации')
                            ->dateTime('d.m.Y H:i'),
                        TextEntry::make('updated_at')
                            ->label('Дата изменения')
                            ->dateTime('d.m.Y H:i'),
                    ])
                    ->columns(2),
            ]);
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AgentStatsWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            AgentActivityChartWidget::class,
            AgentResource\Widgets\AgentAnketaStatsWidget::class
        ];
    }

    public function getTitle(): string
    {
        return "Агент:  {$this->record->name} (ID: {$this->record->id})";
    }
}
