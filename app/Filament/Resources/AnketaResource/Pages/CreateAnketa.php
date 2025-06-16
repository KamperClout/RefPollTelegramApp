<?php

namespace App\Filament\Resources\AnketaResource\Pages;

use App\Filament\Resources\AnketaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnketa extends CreateRecord
{
    protected static string $resource = AnketaResource::class;

    public static function getNavigationLabel(): string
    {
        return 'Создать анкету';
    }
    public function getTitle(): string
    {
        return 'Создание анкеты';
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }

    protected function getCreateFormAction(): Actions\Action
    {
        return parent::getCreateFormAction()
            ->label('Создать анкету');
    }

    protected function getCreateAnotherFormAction(): Actions\Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('Создать еще анкету');
    }
}
