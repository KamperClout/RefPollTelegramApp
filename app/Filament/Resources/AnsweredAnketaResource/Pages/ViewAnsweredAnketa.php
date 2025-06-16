<?php

namespace App\Filament\Resources\AnsweredAnketaResource\Pages;

use App\Filament\Resources\AnsweredAnketaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAnsweredAnketa extends ViewRecord
{
    protected static string $resource = AnsweredAnketaResource::class;


    protected function getHeaderWidgets(): array
    {
        return [];
    }
}
