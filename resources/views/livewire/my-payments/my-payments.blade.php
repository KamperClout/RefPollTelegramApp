<div class="bg-custom rounded-3xl p-3 flex flex-col pb-[56px] max-w-full overflow-x-hidden">
    <div class="flex justify-between items-center mb-4">
        <div style="line-height: 0.8;">
            <p class="text-sc-almost-black font-medium text-[15px]">мои</p>
            <p class="text-[24px] font-semibold text-sc-almost-black">выплаты</p>
        </div>
        <div class="flex items-center justify-center cursor-pointer relative">
            <div wire:navigate
                 href="{{ route('main-page') }}"
                 class="w-10 h-10 bg-white rounded-[12px] flex items-center justify-center">
                <img src="icons/home-2.png" alt="Главная" class="w-6 h-6"/>
            </div>
{{--            <div class="w-10 h-10 bg-white rounded-[12px] flex items-center justify-center">--}}
{{--                <img src="icons/notification.png" alt="Настройки" class="w-6 h-6"/>--}}
{{--            </div>--}}
        </div>
    </div>

    <div class="relative mb-4 h-[180px]">
        <!-- Градиентный фон (самый глубокий слой) -->
        <div class="absolute inset-0 rounded-2xl
                bg-gradient-to-br from-yellow-300/40 via-green-400/50 to-emerald-500/40 opacity-60"></div>

        <!-- Полупрозрачный белый блок (средний слой) -->
        <div class="absolute inset-0 rounded-2xl bg-white/60 m-1.5"></div>

        <!-- Основной контент (передний план) -->
        <div class="relative h-full p-4 flex flex-col justify-between">
            <div class="flex justify-between py-1 px-3 w-full items-center">
                <p class="text-[14px] text-gray-600 mb-1">счет</p>
                <p class="text-[32px] text-gray-800 font-bold">₽ {{$balance}}<span class="text-[24px]"></span></p>
            </div>
{{--            <div class="flex justify-between rounded-2xl border-[2px] border-sc-border py-1 px-3 w-full items-center">--}}
{{--                <p class="text-[12px] text-gray-500">Всего</p>--}}
{{--                <p class="text-[16px] text-gray-800 font-semibold">150 000<span class="text-[14px]">₽</span></p>--}}
{{--            </div>--}}
            <button wire:click="openPopup" class="w-full font-semibold bg-sc-yellow text-sc-almost-black rounded-xl py-1.5 text-[15px] hover:bg-yellow-400 transition">
                Вывести средства
            </button>
        </div>
    </div>

    <!-- Контейнер с транзакциями -->
    <div id="scroll-container" class="overflow-y-auto max-h-[calc(100vh-300px)]">
        @if(count($transactions) != 0)
            @foreach($transactions as $key => $transaction)
                <div class="mb-3 p-4 bg-green-50 rounded-2xl flex justify-between items-center">
                    <div class="flex-1 min-w-0">
                        <p class="text-sc-almost-black font-bold truncate">
                            {{$transaction->description}}
                        </p>
                        <p class="text-sm text-sc-check">
                            <time datetime="{{ $transaction->updated_at->toIso8601String() }}" class="utc-to-local-pretty">
                                {{ $transaction->updated_at->format('Y-m-d H:i:s') }} UTC
                            </time>
                        </p>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                        @if($transaction->type == "deposit")
                            <p class="text-sc-check font-bold">+{{$transaction->amount}}₽</p>
                        @else
                            <p class="text-gray-500 font-bold">{{$transaction->amount}}₽</p>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="mb-3 p-4 bg-green-50 rounded-2xl flex justify-between items-center">
                <div>
                    <p class="text-sc-almost-black font-bold">Транзакции отсутствуют</p>
                    <p class="text-sm text-sc-check"></p>
                </div>
            </div>
        @endif
    </div>
    @if($showPopup)
        <div class="modal-overlay">
            <div class="modal-container">
                <div class="modal-header">
                    <h3 style="color: rgba(13,17,22,0.79)">Вывод средств</h3>
                </div>
                <div class="modal-body">
                    <!-- Номер карты -->
                    <div class="input-group">
                        <label for="cardNumber">Номер карты</label>
                        <input
                            type="text"
                            id="cardNumber"
                            wire:model="cardNumber"
                            placeholder="1234 5678 9012 3456"
                            x-mask="9999 9999 9999 9999"
                        >
                        @error('cardNumber') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    <!-- Сумма -->
                    <div class="input-group">
                        <label for="amount">Сумма</label>
                        <input
                            type="number"
                            id="amount"
                            wire:model="amount"
                            placeholder="1000"
                        >
                        @error('amount') <span class="error-message">{{ $message }}</span> @enderror
                        @if (session()->has('message'))
                            <div class="fixed bottom-4 right-4 text-red-700 px-4 py-2 rounded" style="color: red">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>

                </div>


                <div class="modal-footer">
                    <button wire:click="closePopup" class="cancel-btn">
                        Отмена
                    </button>
                    <button wire:click="withdraw" class="submit-btn">
                        Вывести средства
                    </button>
                </div>
            </div>
        </div>
    @endif
    <style>
        .withdrawal-btn {
            background-color: #3b82f6;
            color: white;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
        }

        .withdrawal-btn:hover {
            background-color: #2563eb;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }

        .modal-container {
            background-color: white;
            border-radius: 0.5rem;
            width: 100%;
            max-width: 28rem;
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(to right, #FCE35AFF, #E5EAC6FF);
            color: white;
            padding: 1rem;
        }

        .modal-header h3 {
            font-size: 1.25rem;
            font-weight: bold;
            margin: 0;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        .input-group label {
            display: block;
            font-size: 0.875rem;
            color: #374151;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .input-group input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .input-group input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            display: block;
            margin-top: 0.25rem;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            padding: 1rem 1.5rem;
            gap: 0.75rem;
        }

        .cancel-btn {
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            color: #374151;
            background-color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cancel-btn:hover {
            background-color: #f3f4f6;
        }

        .submit-btn {
            padding: 0.5rem 1rem;
            background-color: #FCE35AFF;
            color: rgba(13, 17, 22, 0.79);
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #2563eb;
        }

        .success-message {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            background-color: #10b981;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        body.no-scroll, html.no-scroll {
            overflow: hidden;
            height: 100%;
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup-wrapper {
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .popup-content {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 30px;
            text-align: center;
            animation: popupFadeIn 0.3s ease-out;
            overflow-y: auto;
        }

        @keyframes popupFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .popup-message {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .popup-close-button {
            background-color: #1a73e8;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .popup-close-button:hover {
            background-color: #0d5bba;
        }
    </style>
</div>

<script>
    function formatPrettyDate(date) {
        const now = new Date();
        const diffDays = Math.floor((now - date) / (1000 * 60 * 60 * 24));

        if (diffDays === 0) {
            return 'Сегодня в ' + date.toLocaleTimeString('ru-RU', {hour: '2-digit', minute:'2-digit'});
        } else if (diffDays === 1) {
            return 'Вчера в ' + date.toLocaleTimeString('ru-RU', {hour: '2-digit', minute:'2-digit'});
        } else {
            return date.toLocaleDateString('ru-RU', {day: 'numeric', month: 'long'}) +
                ' в ' + date.toLocaleTimeString('ru-RU', {hour: '2-digit', minute:'2-digit'});
        }
    }

    document.querySelectorAll('.utc-to-local-pretty').forEach(el => {
        const utcDate = new Date(el.getAttribute('datetime'));
        el.textContent = formatPrettyDate(utcDate);
    });
</script>
