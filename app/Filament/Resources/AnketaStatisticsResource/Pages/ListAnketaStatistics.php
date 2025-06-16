<?php

namespace App\Filament\Resources\AnketaStatisticsResource\Pages;

use App\Filament\Resources\AnketaStatisticsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnketaStatistics extends ListRecords
{
    protected static string $resource = AnketaStatisticsResource::class;

    protected static ?string $title = 'Статистика анкеты';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
