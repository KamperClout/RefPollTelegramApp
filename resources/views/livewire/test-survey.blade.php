<div class="pb-[56px]">
    <div class="bg-custom rounded-3xl p-3 ">
        <div class="flex justify-between items-center mb-4">
            <div style="line-height: 0.8;">
                <p class="text-sc-almost-black font-medium text-[15px]">мой</p>
                <p class="text-[24px] font-semibold text-sc-almost-black">тест</p>
            </div>
            <div wire:navigate
                 href="{{ route('main-page') }}" class="flex items-center justify-center gap-3 cursor-pointer relative">
                <div class="w-10 h-10 bg-white rounded-[12px] flex items-center justify-center">
                    <img src="icons/home-2.png" alt="Главная" class="w-6 h-6"/>
                </div>
                {{--            <div class="w-10 h-10 bg-white rounded-[12px] flex items-center justify-center">--}}
                {{--                <img src="icons/notification.png" alt="Настройки" class="w-6 h-6"/>--}}
                {{--            </div>--}}
            </div>
        </div>
        <div class="relative mb-4">
            <div class="absolute -inset-1 rounded-lg bg-gradient-to-r from-yellow-600 via-sc-check to-yellow-300 opacity-35 blur-md"></div>
            <div class="relative p-4 rounded-2xl bg-sc-white-72">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <img src="icons/book.png" alt="Обучение" class="w-6 h-6"/>
                    </div>
                    <h3 class="text-lg font-semibold text-sc-almost-black">Как работать с анкетами</h3>
                </div>
                <div class="prose prose-sm max-w-none text-sc-almost-black space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-green-600">Как заполнять:</p>
                            <p>Внимательно читайте каждый вопрос. Если не уверены в ответе, можно пропустить и вернуться позже.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-red-600">Не делайте так:</p>
                            <p>Не оставляйте все ответы на потом. Заполняйте анкету последовательно, это поможет не пропустить важные вопросы.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-green-600">Как делиться:</p>
                            <p>Нажмите кнопку "Поделиться" под анкетой. Вы получите ссылку, которую можно отправить в мессенджере или соцсетях.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-red-600">Не делайте так:</p>
                            <p>Не отправляйте анкету незнакомым людям в личные сообщения. Используйте общие чаты или публичные посты.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="relative">
             <div
                 class="absolute -inset-0.5 rounded-lg bg-gradient-to-r from-yellow-600 via-sc-check to-sc-white-32 opacity-35 blur">
             </div>
             <div class="relative mt-2.5 p-3 rounded-2xl bg-sc-white-72 flex flex-col">
                 <div class="flex justify-between items-center">
                     <div class="text-[24px] text-sc-almost-black font-semibold"></div>
                     <div class="flex justify-between gap-3 ">
                         <div class="text-[16px] text-sc-almost-black">Тест сдан</div>
                         <img src="icons/discount-shape.png" alt="галка" class="w-6 h-6"/>
                     </div>
                 </div>
             </div>
         </div>--}}
    </div>
    <div class="mt-3 rounded-2xl p-3 flex flex-col"
         style="background: rgba(255, 255, 255, 0.64);">
        <!-- Основная форма анкетирования -->
        <div class="">
            <div class="relative p-6 rounded-2xl bg-sc-white-72 flex flex-col space-y-10">
                @foreach($questions as $qkey => $qst)
                    <div>
                        <label class="block text-lg text-sc-almost-black font-semibold">{{$qst->text}}</label>
                        <div class="mt-2 space-y-2">
                            @foreach($qst->answers as $answ)
                                <label class="inline-flex items-center">
                                    <input type="radio" wire:model="answers.{{$qkey}}" value="{{$answ->text}}" name="{{$qst->text}}"
                                           class="form-radio text-yellow-300 h-5 w-5 transition-all">
                                    <span class="ml-2 text-sc-almost-black">{{$answ->text}}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('gender') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
{{--                <div>--}}
{{--                    <label class="block text-lg text-sc-almost-black font-semibold">Ваш пол</label>--}}
{{--                    <div class="mt-2 space-y-2">--}}
{{--                        <label class="inline-flex items-center">--}}
{{--                            <input type="radio" name="gender" value="Мужской"--}}
{{--                                   class="form-radio text-yellow-300 h-5 w-5 transition-all">--}}
{{--                            <span class="ml-2 text-sc-almost-black">Мужской</span>--}}
{{--                        </label>--}}
{{--                        <label class="inline-flex items-center ml-4">--}}
{{--                            <input type="radio" name="gender" value="Женский"--}}
{{--                                   class="form-radio text-yellow-300 h-5 w-5 transition-all">--}}
{{--                            <span class="ml-2 text-sc-almost-black">Женский</span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                    --}}{{-- @error('gender') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror --}}
{{--                </div>--}}
                @endforeach
                @if (session()->has('message'))
                    <div class="alert alert-success font-bold" style="color: red">
                        {{ session('message') }}
                    </div>
                @endif
                <button wire:click="submit" class="mt-6 rounded-md bg-slate-800 py-3 px-6 border border-transparent text-center text-lg text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none
                disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                    Отправить
                </button>
{{--                    @dump(array_search($this->answers[0],$qst->answers->pluck('text')->all()))--}}
{{--                    @dump($this->answers[0],$qst->answers->pluck('text')->all())--}}
                {{--                @dump($answers)--}}
                {{--                @dump($answered)--}}
                {{--                @dump($is_ref)--}}
                {{--                    @dump(json_decode(json_encode($this->answered)))--}}
                {{--                @dump($ref)--}}
                {{--                    <div class="fixed bottom-0 right-0 bg-white p-4 shadow-lg z-50 max-w-xs max-h-40 overflow-auto">--}}
                {{--                        <h3 class="font-bold">Debug: answers[5]</h3>--}}
                {{--                        <pre class="text-xs">{{ json_encode($answers[5] ?? 'Not set', JSON_PRETTY_PRINT) }}</pre>--}}
                {{--                    </div>--}}
            </div>
        </div>
    </div>
    @if($showPopup)
        <div class="popup-overlay">
            <div class="popup-wrapper">
                <div class="popup-content">
                    <div class="popup-message">
                        Тест пройден!
                    </div>
                    <div class="popup-button-container">
                        <button
                            wire:navigate
                            href="{{ route('main-page') }}"
                            class="popup-close-button">
                            Вернуться на главную
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('toggle-body-scroll', (event) => {
                if (event.enabled) {
                    document.body.classList.add('no-scroll');
                    document.documentElement.style.overflow = 'hidden'; // Двойная страховка
                } else {
                    document.body.classList.remove('no-scroll');
                    document.documentElement.style.overflow = '';
                }
            });
        });
        function safeClose() {
            // 1. Пытаемся закрыть Telegram Mini App
            if (window.Telegram?.WebApp?.close) {
                window.Telegram.WebApp.close()
            }
            else window.close()
        }
    </script>
    <style>
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
