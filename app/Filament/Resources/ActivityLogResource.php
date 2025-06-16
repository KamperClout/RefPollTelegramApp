<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Filament\Tables\Actions\ViewAction;

class ActivityLogResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'История изменений';

    protected static ?string $pluralModelLabel = 'История';
    protected static ?int $navigationSort = 100;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('causer.name')
                    ->label('Пользователь')
                    ->default('Система')
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject_type')
                    ->label('Модель')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'App\\Models\\Agent' => 'Агент',
                        'App\\Models\\Anketa' => 'Анкета',
                        'App\\Models\\Test' =>'Тест',
                        default => $state,
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Действие')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'created' => 'Создание',
                        'updated' => 'Обновление',
                        'deleted' => 'Удаление',
                        default => $state,
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject_id')
                    ->label('ID записи')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата')
                    ->dateTime('d.m.Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('subject_type')
                    ->label('Модель')
                    ->options([
                        'App\\Models\\Agent' =>'Агент',
                        'App\\Models\\Anketa' =>'Анкета',
                        'App\\Models\\Test' =>'Тест'
                    ]),
                Tables\Filters\SelectFilter::make('description')
                    ->label('Действие')
                    ->options([
                        'created' => 'Создание',
                        'updated' => 'Обновление',
                        'deleted' => 'Удаление',
                    ]),
            ])
            ->actions([
                ViewAction::make()
                    ->label('Просмотреть')
                    ->modalHeading('Детали изменений')
                    ->modalContent(function ($record) {
                        $properties = is_string($record->properties) ? json_decode($record->properties, true) : $record->properties;
                        $changes = [];

                        if (isset($properties['old']) && isset($properties['attributes'])) {
                            foreach ($properties['attributes'] as $key => $newValue) {
                                $oldValue = $properties['old'][$key] ?? null;
                                if ($oldValue !== $newValue) {
                                    $changes[] = "<div class='mb-2'>
                                        <strong>{$key}:</strong><br>
                                        <span style='color: red;'>" . (is_array($oldValue) ? json_encode($oldValue) : $oldValue) . "</span><br>
                                        <span style='color: green;'>" . (is_array($newValue) ? json_encode($newValue) : $newValue) . "</span>
                                    </div>";
                                }
                            }
                        } elseif (isset($properties['attributes'])) {
                            foreach ($properties['attributes'] as $key => $value) {
                                $changes[] = "<div class='mb-2'>
                                    <strong>{$key}:</strong><br>
                                    <span style='color: green;'>" . (is_array($value) ? json_encode($value) : $value) . "</span>
                                </div>";
                            }
                        }

                        return view('filament.view-changes', [
                            'changes' => $changes,
                            'record' => $record
                        ]);
                    })
                    ->modalWidth('2xl'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
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
            'index' => Pages\ListActivityLogs::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }
    public static function canViewAny(): bool
    {
        return auth()->user()->role == 0; // Только админ
    }
}
