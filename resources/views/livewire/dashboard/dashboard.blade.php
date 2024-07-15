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
        @foreach ($paymentDTOs as $date => $payments)
            <h2>{{ $date }}</h2>
            <ul>
                @foreach ($payments as $payment)
                    <li>{{ $payment['name'] }} {{ $payment['surname'] }} - {{ $payment['amount'] }}</li>
                @endforeach
            </ul>
        @endforeach
    </div>
</div>
