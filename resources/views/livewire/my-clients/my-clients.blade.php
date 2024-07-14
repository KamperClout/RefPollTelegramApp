<div class="container mx-auto">
    <h1 class="text-2xl font-bold text-blue-variant-gray-text">Welcome to your MyClients!</h1>
    <p class="mt-4 text-blue-variant-font">This is the my-clients page.</p>
    <div>
        <p>Всего оплативших: {{ $paidCount }}</p>
        <p>Всего не оплативших: {{ $unpaidCount }}</p>
    </div>
    <div class="mt-4">
        <input type="text" wire:model.lazy="search" class="border rounded p-2" placeholder=""/>
    </div>
    @foreach($clients as $client)
        @if (!$client->is_payment)
            <div>
                {{ $loop->iteration }}. {{ $client->name }} {{ $client->surname }} {{ $client->patronymic }} - {{ $client->phone }}
            </div>
        @endif
    @endforeach
</div>
