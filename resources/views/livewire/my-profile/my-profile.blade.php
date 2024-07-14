<div class="container mx-auto">
    <h1 class="text-2xl font-bold text-blue-variant-gray-text">Welcome to your MyProfile!</h1>
    <p class="mt-4 text-blue-variant-font">This is the my-profile page.</p>
    <div>
        <div>Мой</div>
        <div>Профиль</div>
        <div>{{$surname . ' ' . $name . ' ' . $patronymic}}</div>
        @if ($test_passed)
            <div>
                Тест сдан
            </div>
            <img src="#"/>
        @else
            <div>
                Тест не сдан
            </div>
            <img src="#"/>
        @endif
    </div>
</div>
