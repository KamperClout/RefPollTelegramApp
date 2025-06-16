<div class="bg-custom rounded-3xl p-3 pb-[56px]">
    <div class="flex justify-between items-center mb-4">
        <div style="line-height: 0.8;">
            <p class="text-sc-almost-black font-medium text-[15px]">мой</p>
            <p class="text-[24px] font-semibold text-sc-almost-black">заработок</p>
        </div>
        <div class="flex items-center justify-center gap-3 cursor-pointer relative">
            <div wire:navigate
                 href="{{ route('main-page') }}" class="w-10 h-10 bg-white rounded-[12px] flex items-center justify-center">
                <img src="icons/home-2.png" alt="Главная" class="w-6 h-6"/>
            </div>
        </div>
    </div>
    <div class="relative">
        <div
            class="absolute -inset-0.5 rounded-lg bg-gradient-to-r from-yellow-600 via-sc-check to-sc-green-62 opacity-35 blur">
        </div>
        <div class="relative mt-2.5 p-3 rounded-2xl bg-sc-white-72 flex flex-col">
            <div class="flex justify-between items-center">
                <div class="text-[32px] text-sc-almost-black font-semibold">₽ {{$balance}}</div>
                <div class="text-[16px] text-sc-almost-black font-semibold">cчет</div>
            </div>
            <div class="flex justify-between rounded-2xl border-[2px] border-sc-border py-1 px-3 w-full items-center">
                <div class="text-[14px]">Всего</div>
                <div class="text-[14px] font-semibold">{{$level * 5000}}₽</div>
            </div>
        </div>
    </div>
    <div class="mt-3 rounded-2xl p-1 flex flex-col">
        <div class="relative w-full h-1 bg-gray-300 rounded-xl overflow-hidden">
            <div class="h-full bg-gradient-to-r from-[#F6F8F7] via-[#FEE55A] to-[#A5D376] transition-all duration-500"
                 style="width: {{ $progress }}%"></div>
        </div>
        <div class="flex justify-between rounded-2xl items-center py-1.5">
            <div class="flex items-center justify-center">
                <div class="font-semibold ">Уровень</div>
                <div class="font-semibold ml-2 rounded-2xl bg-sc-almost-black w-12 text-sc-main-font text-center">{{$level}}
                </div>
            </div>
            <div class="font-semibold rounded-2xl border-sc-almost-black border-[2px] w-12 text-center">{{$level+1}}</div>
        </div>
    </div>
    <div class="mt-2.5 p-3 rounded-2xl bg-gradient-to-r from-stone-50 to-yellow-100 flex items-center justify-between">
        <div class="flex flex-col">
            <div class="text-[16px] text-sc-almost-black font-semibold">Список анкет</div>
            <div class="text-[12px] text-sc-gray-text">Заполняйте анкеты самостоятельно и делитесь сслыкой, чтобы получить вознаграждение</div>
        </div>
        <div class="w-8 h-6 bg-sc-yellow rounded-2xl flex items-center justify-center">
            <img src="icons/crown.png" alt="..." class="w-4 h-4"/>
        </div>
    </div>
    <div class="mt-4 w-full">
        <div class="grid grid-cols-3 gap-2">
            <button wire:click="setActiveTab('new')"
                    class="font-semibold text-[14px] rounded-2xl border-2 px-3 py-2 text-center transition
                {{ $activeTab === 'new' ? 'bg-sc-green-32 text-white border-sc-check' : 'bg-white text-sc-almost-black border-gray-200' }}">
                Новые
            </button>
            <button wire:click="setActiveTab('completed')"
                    class="font-semibold text-[14px] rounded-2xl border-2 px-3 py-2 text-center transition
                {{ $activeTab === 'completed' ? 'bg-sc-green-32 text-white border-sc-check' : 'bg-white text-sc-almost-black border-gray-200' }}">
                Заполненные
            </button>
            <button wire:click="setActiveTab('all')"
                    class="font-semibold text-[14px] rounded-2xl border-2 px-3 py-2 text-center transition
                {{ $activeTab === 'all' ? 'bg-sc-green-32 text-white border-sc-check' : 'bg-white text-sc-almost-black border-gray-200' }}">
                Все
            </button>
        </div>
    </div>
    @if ($activeTab === 'new')
        <div class="mt-1 grid grid-cols-3 gap-2 p-1">
            @php
                $answeredIds = \App\Models\AnsweredAnketa::where('agent_id', $id)->where('is_referral', false)->where('status', 'Рассмотрение')->pluck('anketa_id')->toArray();
            @endphp
            @foreach($this->filteredAnketas as $anketa)
                <div class="bg-gradient-to-r from-stone-50 to-sc-green-32 relative flex flex-col w-full bg-white rounded-2xl p-3 text-center font-semibold text-sc-almost-black hover:shadow-lg transition">
                    <div class="text-left text-[14px] mb-3">{{ $anketa->name }}</div>
                    <div class="text-left text-[12px] text-sc-gray-text mb-3">₽ {{ $anketa->price }}</div>
                    <div class="flex flex-col gap-2" style="margin-top: auto;">
                        @if(!in_array($anketa->id, $answeredIds))
                            <a href="{{ route('survey', ['ank' => $anketa->id, 'ref' => $id, 'is_ref' => false]) }}"
                               class="w-full bg-sc-green-32 text-white rounded-xl py-1.5 text-[12px] hover:bg-sc-green-62 transition">
                                Заполнить
                            </a>
                        @endif
                        <button onclick="shareTelegram({{$anketa->id}})"
                                class="w-full bg-sc-yellow text-sc-almost-black rounded-xl py-1.5 text-[12px] hover:bg-yellow-400 transition">
                            Поделиться
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($activeTab === 'completed')
        <div class="mt-1 grid grid-cols-3 gap-2 p-1">
            @php
                $answeredIds = \App\Models\AnsweredAnketa::where('agent_id', $id)->pluck('anketa_id')->toArray();
            @endphp
            @foreach($this->filteredAnketas as $anketa)
                <div class="bg-gradient-to-r from-stone-50 to-sc-green-32 relative flex flex-col w-full bg-white rounded-2xl p-3 text-center font-semibold text-sc-almost-black hover:shadow-lg transition">
                    <div class="text-left text-[14px] mb-3">{{ $anketa->name }}</div>
                    <div class="text-left text-[12px] text-sc-gray-text mb-3">₽ {{ $anketa->price }}</div>
                    <div class="flex flex-col gap-2" style="margin-top: auto;">
                        @if(!in_array($anketa->id, $answeredIds))
                            <a href="{{ route('survey', ['ank' => $anketa->id, 'ref' => $id, 'is_ref' => false]) }}"
                               class="w-full bg-sc-green-32 text-white rounded-xl py-1.5 text-[12px] hover:bg-sc-green-62 transition">
                                Заполнить
                            </a>
                        @endif
                        <button onclick="shareTelegram({{$anketa->id}})"
                                class="w-full bg-sc-yellow text-sc-almost-black rounded-xl py-1.5 text-[12px] hover:bg-yellow-400 transition">
                            Поделиться
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif ($activeTab === 'all')
        <div class="mt-1 grid grid-cols-3 gap-2 p-1">
            @php
                $answeredIds = \App\Models\AnsweredAnketa::where('agent_id', $id)->where('is_referral', false)->where('status', 'Рассмотрение')->pluck('anketa_id')->toArray();
            @endphp
            @foreach($this->filteredAnketas as $anketa)
                <div class="bg-gradient-to-r from-stone-50 to-sc-green-32 relative flex flex-col w-full bg-white rounded-2xl p-3 text-center font-semibold text-sc-almost-black hover:shadow-lg transition">
                    <div class="text-left text-[14px] mb-3">{{ $anketa->name }}</div>
                    <div class="text-left text-[12px] text-sc-gray-text mb-3">₽ {{ $anketa->price }}</div>
                    <div class="flex flex-col gap-2" style="margin-top: auto;">
                        @if(!in_array($anketa->id, $answeredIds))
                            <a href="{{ route('survey', ['ank' => $anketa->id, 'ref' => $id, 'is_ref' => false]) }}"
                               class="w-full bg-sc-green-32 text-white rounded-xl py-1.5 text-[12px] hover:bg-sc-green-62 transition">
                                Заполнить
                            </a>
                        @endif
                        <button onclick="shareTelegram({{$anketa->id}})"
                                class="w-full bg-sc-yellow text-sc-almost-black rounded-xl py-1.5 text-[12px] hover:bg-yellow-400 transition">
                            Поделиться
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
<script>
    const scrollContainer = document.getElementById('scroll-container');

    let isMouseDown = false;
    let startX;
    let scrollLeft;

    scrollContainer.addEventListener('mousedown', (e) => {
        isMouseDown = true;
        startX = e.pageX - scrollContainer.offsetLeft;
        scrollLeft = scrollContainer.scrollLeft;
    });

    scrollContainer.addEventListener('mouseleave', () => {
        isMouseDown = false;
    });

    scrollContainer.addEventListener('mouseup', () => {
        isMouseDown = false;
    });

    scrollContainer.addEventListener('mousemove', (e) => {
        if (!isMouseDown) return;
        e.preventDefault();
        const x = e.pageX - scrollContainer.offsetLeft;
        const walk = (x - startX) * 1.5;
        scrollContainer.scrollLeft = scrollLeft - walk;
    });

    function shareTelegram(anketaId) {
        const text = 'Присоединяйтесь к опросу!';
        //const shareUrl = `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`;
        const url = "https://t.me/TgAppCreatrixBot/TgAppCreatrix?startapp=ank=" + anketaId + "_ref=" + {{$id}}
        //window.open(shareUrl, '_blank');
        Telegram.WebApp.openTelegramLink(`https://t.me/share/url?url=${encodeURIComponent(url)}&text=${text}`);
    }

</script>
