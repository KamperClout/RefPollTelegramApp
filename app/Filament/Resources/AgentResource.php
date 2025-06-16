<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgentResource\Pages;
use App\Filament\Resources\AgentResource\RelationManagers;
use App\Models\Agent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AgentResource\RelationManagers\TransactionsRelationManager;

class AgentResource extends Resource
{
    protected static ?string $model = Agent::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Агенты';
    protected static ?string $modelLabel = "Агенты";
    protected static ?string $label = "Агенты";
    protected static ?string $pluralModelLabel = "Агенты";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tg_id')->label("ID Telegram")
                    ->required()
                    ->maxLength(300),
                Forms\Components\TextInput::make('name')->label("Имя Telegram")
                    ->maxLength(300),
                Forms\Components\TextInput::make('phone')->label("Телефон")
                    ->tel()
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('region')->label("Регион")
                    ->maxLength(300),
                Forms\Components\Toggle::make('is_qualified')->label("Квалифицирован")
                    ->required(),
                Forms\Components\Toggle::make('is_banned')->label("Заблокирован")
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tg_id')->label("ID Telegram")
                    ->searchable(),
                Tables\Columns\TextColumn::make('id')
                    ->label('ID агента')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')->label("Имя")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')->label("Телефон")
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')->label("Регион")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_qualified')->label("Квалифицирован")
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_banned')->label("Блокирован")
                    ->boolean(),
                Tables\Columns\TextColumn::make('total_earnings')
                    ->label('Баланс')
                    ->getStateUsing(fn (Agent $record) => $record->getBalance())
                    ->money('RUB'),
                Tables\Columns\TextColumn::make('total_answered')
                    ->label('Заполнено анкет')
                    ->getStateUsing(fn (Agent $record) => $record->answeredCount()),
                Tables\Columns\TextColumn::make('deleted_at')->label("Удален")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')->label("Создан")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->label("Обновлен")
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->emptyStateHeading('Агенты не найдены')
            ->emptyStateIcon('heroicon-o-user');
    }
    public static function canViewAny(): bool
    {
        return auth()->user()->role == 0; // Только админ
    }

    public static function getRelations(): array
    {
        return [
            TransactionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgents::route('/'),
            'create' => Pages\CreateAgent::route('/create'),
            'edit' => Pages\EditAgent::route('/{record}/edit'),
            'view' => Pages\ViewAgent::route('/{record}'),
        ];
    }
}
