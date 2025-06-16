<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnketaStatisticsResource\Pages;
use App\Filament\Resources\AnketaStatisticsResource\RelationManagers;
use App\Models\Anketa;
use App\Models\AnsweredAnketa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnketaStatisticsResource extends Resource
{
    protected static ?string $model = Anketa::class;
    protected static ?string $navigationLabel = 'Статистика анкеты';

    protected static ?string $label = "Статистики";
    protected static ?string $pluralModelLabel = "Статистика";

    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';
    protected static ?string $navigationGroup = 'Анкеты';

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()->role === 0) { // если админ
            return $query;
        }
        return $query->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Название анкеты')->searchable(),
                Tables\Columns\TextColumn::make('answered_anketas_count')
                    ->counts('answeredAnketas')
                    ->label('Всего заполнено'),
                Tables\Columns\TextColumn::make('approved_count')
                    ->label('Одобрено')
                    ->getStateUsing(fn($record) => $record->answeredAnketas()->where('status', 'Одобрено')->count()),
                Tables\Columns\TextColumn::make('rejected_count')
                    ->label('Отклонено')
                    ->getStateUsing(fn($record) => $record->answeredAnketas()->where('status', 'Отклонено')->count()),
                Tables\Columns\TextColumn::make('pending_count')
                    ->label('На рассмотрении')
                    ->getStateUsing(fn($record) => $record->answeredAnketas()->where('status', 'Рассмотрение')->count()),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnketaStatistics::route('/'),
            'edit' => Pages\EditAnketaStatistics::route('/{record}/edit'),
            'view' => Pages\ViewAnketaStatistics::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
