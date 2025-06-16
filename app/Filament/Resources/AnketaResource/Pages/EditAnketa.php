<?php

namespace App\Filament\Resources\AnketaResource\Pages;

use App\Filament\Resources\AnketaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnketa extends EditRecord
{
    protected static string $resource = AnketaResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'Редактирование анкеты';
    }
}
