<?php

namespace App\Filament\Resources\AgentResource\Widgets;

use App\Models\Agent;
use App\Models\Transaction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class AgentRecentActivityWidget extends BaseWidget
{
    public ?Agent $record = null;

    protected static ?string $heading = 'Последние транзакции';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Transaction::query()
                    ->whereHas('wallet', function ($query) {
                        $query->where('agent_id', $this->record->id);
                    })
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->label('Сумма')
                    ->money('RUB')
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Тип')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'deposit' => 'success',
                        'withdrawal' => 'danger',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
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
            ->defaultSort('created_at', 'desc');
    }
}
