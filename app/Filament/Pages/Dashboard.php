<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\FilledAnketaWidget;
use App\Filament\Widgets\NewClientsWidget;
use App\Filament\Widgets\TotalAnsweredWidget;
use App\Filament\Widgets\TotalClientsWidget;
use Filament\Pages\Page;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;

class Dashboard extends Page
{

    protected static string $view = 'filament.pages.dashboard';
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Главная';
    protected static ?string $modelLabel = "Главная";
    protected static ?string $label = "Главная";
    protected static ?string $slug = 'dashboard';
    protected static ?string $pluralModelLabel = "Главная";
    protected static ?string $title = 'Добро пожаловать!';
    protected function getHeaderWidgets(): array
    {
        return [
            NewClientsWidget::class,
            FilledAnketaWidget::class,
            TotalClientsWidget::class,
            TotalAnsweredWidget::class,
        ];
    }
    public static function getColumns(): int | array
    {
        return [
            'default' => 3,
            'sm' => 1,
        ];
    }
}
