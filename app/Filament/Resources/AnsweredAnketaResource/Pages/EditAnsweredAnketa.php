<?php

namespace App\Filament\Resources\AnsweredAnketaResource\Pages;

use App\Filament\Resources\AnsweredAnketaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnsweredAnketa extends EditRecord
{
    protected static string $resource = AnsweredAnketaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Просмотр и изменение статуса';
    }
}
