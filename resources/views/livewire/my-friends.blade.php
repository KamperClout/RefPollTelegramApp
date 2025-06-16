<div class="bg-custom rounded-3xl p-3 flex flex-col pb-[56px]">
    <div class="flex justify-between items-center mb-4">
        <div style="line-height: 0.8;">
            <p class="text-sc-almost-black font-medium text-[15px]">мои</p>
            <p class="text-[24px] font-semibold text-sc-almost-black">друзья</p>
        </div>
        <div class="flex items-center justify-center gap-3 cursor-pointer relative">
            <div wire:navigate
                 href="{{ route('main-page') }}"
                 class="w-10 h-10 bg-white rounded-[12px] flex items-center justify-center">
                <img src="icons/home-2.png" alt="Главная" class="w-6 h-6"/>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto">
        <div class="relative rounded-2xl p-6 mb-4 min-h-[150px]">
            <div
                class="absolute inset-0 bg-gradient-to-br from-green-100 to-amber-100 backdrop-blur-[1px] rounded-2xl"></div>
            <div class="relative z-10 h-full flex flex-col items-center justify-center">
                <h2 class="text-2xl font-semibold text-gray-800 mb-2">Пригласите друзей!</h2>
                <p class="text-sc-gray-text mb-6">Вы и ваши друзья можете получить бонусы</p>
            </div>
        </div>

        <div class="space-y-3 mb-4">
            <div {{--wire:click="shareTelegram"--}}
                 onclick="shareTelegram('{{$this->getReferralLink()}}')"
                 class="group flex justify-between items-center bg-white/80 hover:bg-white/90 p-3 rounded-lg transition-all cursor-pointer">
                <div class="flex flex-col">
                    <span class="text-sc-almost-black font-semibold text-[14px]">Пригласить друга</span>
                    <span class="text-sc-check font-semibold text-[13px]">+1000₽</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 text-gray-400 group-hover:text-gray-500 transition-all" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </div>

            <div {{--wire:click="shareTelegram" onclick="window.open('{{ $this->shareTelegram() }}', '_blank')"--}}
                 class="group flex justify-between items-center bg-white/80 hover:bg-white/90 p-3 rounded-lg transition-all">
                <div class="flex flex-col">
                    <span class="text-sc-almost-black font-semibold text-[14px]">За каждого приглашенного от вашего друга вы тоже получаете вознаграждение!</span>
                    <span class="text-sc-check font-semibold text-[13px]">+100₽</span>
                </div>
{{--                <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                     class="h-5 w-5 text-gray-400 group-hover:text-gray-500 transition-all" fill="none"--}}
{{--                     viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>--}}
{{--                </svg>--}}
            </div>
        </div>
        <!-- Список друзей -->
        <div class="bg-white rounded-2xl p-3 flex-1 min-h-16 overflow-y-auto">
            <div class="mb-4">
                <p class="font-semibold text-sc-gray-text text-[16px]">Список</p>
                <p class="font-semibold text-sc-almost-black text-[20px]">Друзей</p>
            </div>

            <div class="relative">
                <div class="relative w-full h-full mt-3">
                    <div
                        class="absolute left-[29px] top-2 w-[16px] h-[16px] bg-[url('/images/search-normal.png')]"></div>
                    <input wire:model.live="search" type="text"
                           class="w-full h-[40px] rounded-[12px] bg-gray-200 mb-[4px] pl-12 border-none"
                           placeholder="Поиск по друзьям"/>

                    <div>
                        @if(count($invited) != 0)
                            @foreach($invited as $key => $inv)
                                <div
                                    class="w-full h-[70px] bg-white rounded-[20px] mb-3 border-2 border-sc-border flex items-center px-3">
                                    <div
                                        class="w-10 h-10 bg-white rounded-[12px] border border-sc-border flex items-center justify-center mr-3">
                                        {{$loop->iteration}}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sc-almost-black text-[16px] font-semibold">
                                            @if($inv->name)
                                                {{$inv->name}}
                                            @else
                                                Пользователь #{{$inv->id}}
                                            @endif
                                        </span>
                                        <span class="text-sc-gray-text text-[14px]">
                                            @if($inv->phone)
                                                {{$inv->phone}}
                                            @else
                                                Телефон не указан
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div
                                class="w-full h-[70px] bg-white rounded-[20px] mb-3 border-2 border-sc-border flex items-center px-3">
                                <div
                                    class="w-10 h-10 bg-white rounded-[12px] border border-sc-border flex items-center justify-center mr-3">
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sc-almost-black text-[16px] font-semibold">Приглашенных друзей нет :(</span>
                                    <span class="text-sc-gray-text text-[14px]">Пригласите друзей, чтобы они появились здесь!</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function shareTelegram(url) {
            const text = 'Привет! Присоединяйся ко мне в приложении. Вот моя реферальная ссылка: ';
            const shareUrl = `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
            //window.open(shareUrl, '_blank');
            Telegram.WebApp.openTelegramLink(`https://t.me/share/url?url=${encodeURIComponent(url)}&text=${text}`);
        }
    </script>
</div>
