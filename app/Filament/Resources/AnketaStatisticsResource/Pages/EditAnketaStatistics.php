<?php

namespace App\Filament\Resources\AnketaStatisticsResource\Pages;

use App\Filament\Resources\AnketaStatisticsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnketaStatistics extends EditRecord
{
    protected static string $resource = AnketaStatisticsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
