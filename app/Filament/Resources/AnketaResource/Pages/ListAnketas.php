<?php

namespace App\Filament\Resources\AnketaResource\Pages;

use App\Filament\Resources\AnketaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnketas extends ListRecords
{
    protected static string $resource = AnketaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
