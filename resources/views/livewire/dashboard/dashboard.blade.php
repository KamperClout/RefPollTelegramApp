<div class="container mx-auto">
    <h1 class="text-2xl font-bold text-blue-variant-gray-text">Welcome to your Dashboard!</h1>
    <p class="mt-4 text-blue-variant-font">This is the dashboard page.</p>
    <div>Мои</div>
    <div>Выплаты</div>
    <div>
        <div>{{'₽' . ' ' . $rubles}}</div>
        <div>{{'.' . $copecks}}</div>
    </div>
    <div>
        <select wire:model="sortSelected" wire:change="sortBy()">
            <option value="createdAt asc">Последние Транзакции</option>
            <option value="createdAt desc">Старые Транзакции</option>
        </select>
    </div>
    <div>
        @foreach ($paymentDTOs as $date => $payments)
            <h2>{{ $formatDate($date) }}</h2>
            @foreach ($payments as $index => $payment)
                @if ($loop->first || $loop->last)
                    <div style="background-color: green;">
                        <div>
                            {{ $payment['surname'] }} {{ $payment['name'] }}
                        </div>
                        <div>
                            {{'+ ' . $payment['amount'] }}
                        </div>
                    </div>
                @else
                    <div style="background-color: gray;">
                        <div>
                            {{ $payment['surname'] }} {{ $payment['name'] }}
                        </div>
                        <div>
                            {{ $payment['amount'] }}
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
</div>
