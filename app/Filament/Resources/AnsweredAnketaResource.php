<?php

namespace App\Filament\Resources;

use App\Exports\AnsweredAnketasExport;
use App\Filament\Resources\AnsweredAnketaResource\Pages;
use App\Filament\Resources\AnsweredAnketaResource\RelationManagers;
use App\Models\Anketa;
use App\Models\AnsweredAnketa;
use Filament\Forms;
use Filament\Forms\Components\Divider;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Split;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use Filament\Infolists\Infolist;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Card;

class AnsweredAnketaResource extends Resource
{
    protected static ?string $model = AnsweredAnketa::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Заполненные анкеты';
    protected static ?string $navigationGroup = 'Анкеты';
    protected static ?string $label = "Заполненные анкеты";
    protected static ?string $pluralModelLabel = "Заполненные";
    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        \Filament\Forms\Components\Section::make('Ответы на вопросы')
                            ->schema(function ($record) {
                                $answers = is_array($record->answers) ? $record->answers : json_decode($record->answers, true);
                                $blocks = [];
                                foreach ($answers as $question => $answer) {
                                    if (is_array($answer)) {
                                        $answer = implode(', ', $answer);
                                    }
                                    $blocks[] = \Filament\Forms\Components\Card::make()
                                        ->schema([
                                            \Filament\Forms\Components\Placeholder::make($question)
                                                ->label($question)
                                                ->content($answer)
                                                ->extraAttributes([
                                                    'class' => 'text-lg font-medium text-gray-900',
                                                ])
                                        ])
                                        ->extraAttributes([
                                            'class' => 'mb-4 shadow-sm hover:shadow-md transition-shadow duration-200',
                                        ]);
                                }
                                return $blocks;
                            })
                            ->columnSpan(3),
                        \Filament\Forms\Components\Section::make('Статус')
                            ->schema([
                                \Filament\Forms\Components\Radio::make('status')
                                    ->label('Статус')
                                    ->options([
                                        'Рассмотрение' => 'Рассмотрение',
                                        'Одобрено' => 'Одобрено',
                                        'Отклонено' => 'Отклонено',
                                    ])
                                    ->inline()
                                    ->required(),
                            ])
                            ->columnSpan(1)
                            ->extraAttributes([
                                'style' => 'max-width: 320px; min-width: 220px; margin-left: auto; margin-right: 0;',
                            ]),
                    ])
                    ->columns(4),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Ответы')
                    ->schema(function ($record) {
                        $answers = is_array($record->answers) ? $record->answers : json_decode($record->answers, true);
                        $blocks = [];
                        foreach ($answers as $question => $answer) {
                            $blocks[] = TextEntry::make($question)
                                ->label($question)
                                ->default($answer); // или ->state($answer)
                        }
                        return $blocks;
                    }),
            ]);
    }
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('agent.id')
                    ->label('Агент ID')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('anketa.name')
                    ->label('Анкета')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Дата отправки')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),

                BadgeColumn::make('status')
                    ->label('Статус')
                    ->badge(function (AnsweredAnketa $record) {
                        return $record->status;
                    })
                    ->colors([
                        'primary' => 'Рассмотрение',
                        'success' => 'Одобрено',
                        'danger' => 'Отклонено',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label("Статус")
                    ->options([
                        'Рассмотрение' => 'Рассмотрение',
                        'Одобрено' => 'Одобрено',
                        'Отклонено' => 'Отклонено',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('export')
                    ->label('Экспорт в Excel')
                    ->action(function (Collection $records) {
                        return (new AnsweredAnketasExport($records))->download('answered-anketas.xlsx');
                    })
            ])
            ->searchable();

    }

    public static function getRelations(): array
    {
        return [
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnsweredAnketas::route('/'),
            'edit' => Pages\EditAnsweredAnketa::route('/{record}/edit'),
            'view' => Pages\ViewAnsweredAnketa::route('/{record}'),
        ];
    }
    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        $query = static::getModel()::where('status', 'Рассмотрение');

        if (auth()->user()->role !== 0) { // если не админ
            $anketaIds = Anketa::where('user_id', auth()->id())->pluck('id');
            $query->whereIn('anketa_id', $anketaIds);
        }

        return $query->count();
    }
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()->role === 0) { // если админ
            return $query;
        }

        // Получаем ID анкет, созданных текущим пользователем
        $anketaIds = Anketa::where('user_id', auth()->id())->pluck('id');

        return $query->whereIn('anketa_id', $anketaIds);
    }

    public static function getModelLabel(): string
    {
        return 'заполненную анкету'; // в единственном числе
    }

    public static function getPluralModelLabel(): string
    {
        return 'заполненные анкеты'; // во множественном числе
    }
}
