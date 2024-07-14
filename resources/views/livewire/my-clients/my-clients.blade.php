<div class="container mx-auto">
    <h1 class="text-2xl font-bold text-blue-variant-gray-text">Welcome to your MyClients!</h1>
    <p class="mt-4 text-blue-variant-font">This is the my-clients page.</p>
    <div>
        <p>Всего оплативших: {{ $paidCount }}</p>
        <p>Всего не оплативших: {{ $unpaidCount }}</p>
    </div>
    <div class="mt-4">
        <!-- Форма поиска по ФИО -->
        <input type="text" wire:model="search" placeholder="Поиск по ФИО..." class="p-2 border border-gray-300 rounded-md"/>
    </div>
    @foreach($clients as $client)
        @if (!$client->is_payment)
            <div>
                {{ $loop->iteration }}. {{ $client->name }} {{ $client->surname }} {{ $client->patronymic }} - {{ $client->phone }}
            </div>
        @endif
    @endforeach
    {{ $clients->links() }}
</div>
