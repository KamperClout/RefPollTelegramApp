<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestResource\Pages;
use App\Filament\Resources\TestResource\RelationManagers;
use App\Models\Test;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestResource extends Resource
{
    protected static ?string $model = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?string $modelLabel = "Тесты";
    protected static ?string $label = "Тесты";
    protected static ?string $pluralModelLabel = "Тесты";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Основная сетка
                Grid::make(2)
                    ->schema([
                        // Секция для названия теста
                        Card::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label('Название теста')
                                    ->placeholder('Например: Тест по математике')
                                    ->hint('Введите уникальное название теста')
                                    ->required()
                                    ->live(),
                            ]),
                    ]),
                // Раздел с вопросами теста
                Section::make('Вопросы теста')
                    ->description('Добавьте вопросы с вариантами ответов')
                    ->schema([
                        // Динамичное добавление вопросов
                        Repeater::make('questions')
                            ->label('Вопросы')
                            ->relationship('questions')
                            ->schema([
                                Card::make()
                                    ->schema([
                                        TextInput::make('text')
                                            ->label('Текст вопроса')
                                            ->placeholder('Введите вопрос')
                                            ->required()
                                            ->live(),

                                        // Варианты ответа для radio
                                        Repeater::make('answers')
                                            ->label('Варианты ответа')
                                            ->relationship('answers')
                                            ->schema([
                                                Grid::make(2)
                                                    ->schema([
                                                        TextInput::make('text')
                                                            ->label('Вариант ответа')
                                                            ->required()
                                                            ->live(),
                                                        Forms\Components\Checkbox::make('is_correct')
                                                            ->label('Правильный ответ')
                                                            ->inline()
                                                            ->required()
                                                            ->live(),
                                                    ]),
                                            ])
                                            ->minItems(2)
                                            ->maxItems(4)
                                            ->columnSpan('full')
                                            ->live(),
                                    ])
                                    ->columnSpan('full'),
                            ])
                            ->columnSpan('full')
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['text'] ?? null),
                    ]),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->heading('Мои тесты')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label("Название"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTests::route('/'),
            'create' => Pages\CreateTest::route('/create'),
            'edit' => Pages\EditTest::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        return auth()->user()->role == 0; // Только админ
    }
}
