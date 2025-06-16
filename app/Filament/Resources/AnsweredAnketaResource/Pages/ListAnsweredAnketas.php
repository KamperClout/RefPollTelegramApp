<?php

namespace App\Filament\Resources\AnsweredAnketaResource\Pages;

use App\Filament\Resources\AnsweredAnketaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnsweredAnketas extends ListRecords
{
    protected static string $resource = AnsweredAnketaResource::class;

    protected static ?string $title = 'Заполненные анкеты';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
