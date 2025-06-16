<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnketaResource\Pages;
use App\Filament\Resources\AnketaResource\RelationManagers;
use App\Models\Anketa;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;

class AnketaResource extends Resource
{
    protected static ?string $model = Anketa::class;

    protected static ?string $modelLabel = "Анкеты";
    protected static ?string $label = "Анкеты";
    protected static ?string $pluralModelLabel = "Анкеты";

    protected static ?string $navigationIcon = 'heroicon-o-pencil';
    protected static ?string $navigationLabel = 'Созданные анкеты';
    protected static ?int $navigationSort = 1;

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
                // Основная сетка
                Grid::make(2)
                    ->schema([

                        // Секция для названия анкеты и цены
                        Card::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label('Название анкеты')
                                    ->placeholder('Например: Опрос по качеству сервиса')
                                    ->hint('Введите уникальное название анкеты')
                                    ->required()
                                    ->live(), // Динамическое обновление
                            ]),
                        Card::make()
                            ->schema([
                                TextInput::make('price')
                                    ->label('Цена анкеты')
                                    ->numeric()
                                    ->prefix('₽')
                                    ->required()
                                    ->minValue(30) // Цена не меньше 30
                                    ->placeholder('минимум 30 ₽'), // Плейсхолдер
                            ]),

                    ]),
                // Раздел с вопросами анкеты
                Section::make('Вопросы анкеты')
                    ->description('Добавьте вопросы для вашей анкеты')
                    ->schema([

                        // Динамичное добавление вопросов
                        Repeater::make('questions')
                            ->label('Вопросы')
                            ->relationship('questions')
                            ->addActionLabel('Добавить к вопросам')
                            ->schema([
                                // Вопросы с текстом
                                Card::make()
                                    ->schema([

                                        TextInput::make('text')
                                            ->label('Текст вопроса')
                                            ->placeholder('Введите сам вопрос')
                                            ->required()
                                            ->validationMessages([
                                                'required' => 'Это поле обязательно для заполнения',
                                            ])
                                            ->live(), // Динамическое обновление

                                        // Тип вопроса (Select)
                                        Select::make('type')
                                            ->label('Тип вопроса')
                                            ->options([
                                                'text' => 'Текст',
                                                'radio' => 'Один из списка',
                                                'checkbox' => 'Несколько из списка',
                                                'bool' => 'Да/Нет',
                                                'select' => 'Выпадающий список',
                                            ])
                                            ->required()
                                            ->validationMessages([
                                                'required' => 'Это поле обязательно для заполнения',
                                            ])
                                            ->live()
                                            ->afterStateUpdated(fn ($state, $set) => $set('preview', null)), // Сбрасываем предварительный просмотр

                                        // Варианты ответа для radio/checkbox/select
                                        Repeater::make('answers')
                                            ->label('Варианты ответа')
                                            ->addActionLabel('Добавить к вариантам')
                                            ->relationship('answers')
                                            ->schema([
                                                TextInput::make('text')
                                                    ->label('Вариант')
                                                    ->required()
                                                    ->validationMessages([
                                                        'required' => 'Это поле обязательно для заполнения',
                                                    ])
                                                    ->live(),
                                            ])
                                            ->visible(fn ($get) => in_array($get('type'), ['radio', 'checkbox', 'select'])) // Показываем только для radio, checkbox, select
                                            ->minItems(2)
                                            ->columnSpan('full')
                                            ->live(),

                                        // Динамический предпросмотр
                                        Fieldset::make('Предпросмотр')
                                            ->schema([

                                                // Пример для radio
                                                Radio::make('preview_radio')
                                                    ->label('Пример отображения')
                                                    ->options(fn ($get) => collect($get('answers'))->pluck('text', 'text')->toArray())
                                                    ->visible(fn ($get) => $get('type') === 'radio' && !empty($get('answers')))
                                                    ->disabled(),

                                                // Пример для checkbox
                                                CheckboxList::make('preview_checkbox')
                                                    ->label('Пример отображения')
                                                    ->options(fn ($get) => collect($get('answers'))->pluck('text', 'text')->toArray())
                                                    ->visible(fn ($get) => $get('type') === 'checkbox' && !empty($get('answers')))
                                                    ->disabled(),

                                                // Пример для bool (Yes/No)
                                                Toggle::make('preview_bool')
                                                    ->label('Пример отображения')
                                                    ->visible(fn ($get) => $get('type') === 'bool')
                                                    ->disabled(),

                                                // Пример для text
                                                Textarea::make('preview_text')
                                                    ->label('Пример отображения')
                                                    ->placeholder('Ответ пользователя...')
                                                    ->visible(fn ($get) => $get('type') === 'text')
                                                    ->disabled(),

                                                // Пример для select (выпадающий список)
                                                Select::make('preview_select')
                                                    ->label('Пример отображения')
                                                    ->options(fn ($get) => collect($get('answers'))->pluck('text', 'text')->filter(fn ($value) => !is_null($value))->toArray())
                                                    ->visible(fn ($get) => $get('type') === 'select' && !empty($get('answers')))
                                                    ->disabled(),

                                            ])
                                            ->columnSpan('full'), // Занимает всю ширину

                                    ])
                                    ->columnSpan('full'),

                            ])
                            ->columnSpan('full')
                            ->reorderable() // Даем возможность менять порядок вопросов
                            ->collapsible() // Даем возможность скрывать/раскрывать вопросы
                            ->itemLabel(fn (array $state): ?string => $state['text'] ?? null), // Отображаем текст вопроса в качестве метки

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->label("Название"),
                Tables\Columns\TextColumn::make('price')->searchable()->label("Цена")
                    ->money('RUB'),
                Tables\Columns\TextColumn::make("user.name")
                    ->searchable()
                    ->label("Пользователь")
                    ->visible(fn (): bool => auth()->user()->role == 0), // Только админ видит этот столбец
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
            ])
            ->emptyStateHeading('Анкеты не найдены');

    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnketas::route('/'),
            'create' => Pages\CreateAnketa::route('/create'),
            'edit' => Pages\EditAnketa::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'анкету'; // в единственном числе
    }

    public static function getPluralModelLabel(): string
    {
        return 'анкеты'; // во множественном числе
    }
}
