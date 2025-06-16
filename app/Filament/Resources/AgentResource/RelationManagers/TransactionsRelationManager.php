<?php

namespace App\Filament\Resources\AgentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Transaction;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'wallet';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Транзакции';

    public function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return Transaction::query()
            ->whereHas('wallet', function ($query) {
                $query->where('agent_id', $this->getOwnerRecord()->id);
            });
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->label('Сумма')
                    ->money('RUB')
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'deposit' => 'success',
                        'withdrawal' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'deposit' => 'Пополнение',
                        'withdrawal' => 'Списание',
                    }),
                Tables\Columns\TextColumn::make('description')
                    ->label('Описание')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Тип')
                    ->options([
                        'deposit' => 'Пополнение',
                        'withdrawal' => 'Списание',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Транзакций не найдено')
            ->emptyStateDescription('Для этого агента пока нет транзакций.')
            ->emptyStateIcon('heroicon-o-currency-dollar');
    }
}
