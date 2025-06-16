<div class="p-3">
    <div class="flex justify-between items-center mb-4">
        <div style="line-height: 0.8;">
            <p class="text-sc-almost-black font-medium text-[15px]">Анкета</p>
            <p class="text-[24px] font-semibold text-sc-almost-black">{{$anketa->name}}</p>
        </div>
        @if(!$is_ref)
        <div class="flex items-center justify-center gap-3 cursor-pointer relative">
            <div wire:navigate
                 href="{{ route('main-page') }}"
                 class="w-10 h-10 bg-white rounded-[12px] flex items-center justify-center">
                <img src="icons/home-2.png" alt="Главная" class="w-6 h-6"/>
            </div>
        </div>

        @endif
    </div>
    <div class="mt-3 rounded-2xl p-3 flex flex-col"
         style="background: rgba(255, 255, 255, 0.64);">
        <!-- Основная форма анкетирования -->
        <div class="">
            <div class="relative p-6 rounded-2xl bg-sc-white-72 flex flex-col space-y-10">
                @foreach($questions as $qkey => $qst)
                    @switch($qst->type)

                        @case("text")
                            <div>
                                <label for="name"
                                       class="block text-lg text-sc-almost-black font-semibold">{{$qst->text}}</label>
                                <input type="text" id="name" wire:model="answers.{{$qkey}}" name="name"
                                       placeholder="Введите ответ"
                                       class="mt-2 p-3 w-full border border-sc-border rounded-2xl focus:outline-none focus:ring-2 focus:ring-yellow-300 text-sc-almost-black transition-all duration-200 hover:shadow-md">
                                @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            @break

                        @case("radio")
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
                            @break

                        @case("select")
                            <div class="w-50%">
                                <label for="country" class="block text-lg text-sc-almost-black font-semibold">{{$qst->text}}</label>

                                <select id="country" wire:model="answers.{{$qkey}}"
                                        class="mt-2 p-3 w-full border border-sc-border rounded-2xl focus:outline-none focus:ring-2 focus:ring-yellow-300 text-sc-almost-black transition-all duration-200 hover:shadow-md">
                                    @foreach($qst->answers as $key => $answ)
                                        <option value="{{$answ->text}}">{{$answ->text}}</option>
                                    @endforeach
                                </select>
                                @error('country') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            @break

                        @case("checkbox")
                            <div>
                                <label class="block text-lg text-sc-almost-black font-semibold">{{$qst->text}}</label>
                                <div class="mt-2 space-y-2">
                                    @foreach($qst->answers as $key => $answ)
                                        <label class="flex items-center space-x-3">
                                            <input type="checkbox" wire:model="answers.{{$qkey}}.{{$answ->text}}"
                                                   class="form-checkbox h-5 w-5 text-yellow-300 rounded transition-all" value="{{$answ->text}}">
                                            <span class="text-sc-almost-black">{{$answ->text}}</span>
                                        </label>
                                    @endforeach

                                </div>
                                @error('interests') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            @break

                        @case("bool")
                            <div>
                                <label for="notifications" class="block text-lg text-sc-almost-black font-semibold">{{$qst->text}}</label>
                                <div class="mt-2 flex items-center">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" id="notifications" wire:model="answers.{{$qkey}}" class="sr-only peer" value="false">
                                        <div
                                            class="w-11 h-6 bg-gray-200 rounded-full peer-checked:bg-yellow-300 transition-all duration-300"></div>
                                        <div
                                            class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full peer-checked:translate-x-5 transition-all duration-300"></div>
                                    </label>
                                    <span class="ml-3 text-sc-almost-black">Нет/Да</span>
                                </div>
                                @error('notifications') <span
                                    class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            @break

                    @endswitch

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
                        Анкета отправлена
                    </div>
                    <div class="popup-button-container">
                        <button
                            @if($is_ref)
                                onclick="window.Telegram.WebApp.close()"
                            @else
                                wire:navigate
                            href="{{ route('main-page') }}"
                            @endif
                            class="popup-close-button">
                            @if($is_ref)
                                Закрыть
                            @else
                                Вернуться на главную
                            @endif
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

