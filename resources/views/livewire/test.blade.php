<div class="bg-custom rounded-3xl p-3">
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
    <div class="mt-3 grid grid-cols-2 gap-2 p-1 ">
        <div
            class="relative flex flex-col justify-between items-center w-50 h-28 bg-white rounded-2xl p-4 text-left font-semibold text-sc-almost-black" style="line-height: 1.2;">
            <div
                class="absolute top-4 right-3 rounded-2xl flex justify-center items-center text-center text-[12px] cursor-pointer">
                <img src="icons/headphone.png" alt="наушники" class="w-10 h-10">
            </div>
            <div class="mt-auto ">Связаться с поддержкой</div>
        </div>
        <div
            class="relative flex flex-col justify-between items-center w-50 h-28 bg-white rounded-2xl p-4 text-left font-semibold text-sc-almost-black" style="line-height: 1.2;">
            <div
                class="absolute top-4 right-3 flex justify-center items-center text-center text-[12px] cursor-pointer">
                <img src="icons/document-text.png" alt="документ" class="w-10 h-10">
            </div>
            <div class="mt-auto">Реквизиты самозанятого</div>
        </div>
        <div
            class="relative flex flex-col justify-between items-center w-50 h-28 bg-white rounded-2xl p-4 text-left font-semibold text-sc-almost-black" style="line-height: 1.2;">
            <div class="absolute top-4 right-3 flex justify-center items-center text-center text-[12px] cursor-pointer">
                <img src="icons/book.png" alt="книга" class="w-10 h-10">
            </div>
            <div class="mt-auto">Маркетинговые материалы</div>
        </div>
        <div
            class="relative flex flex-col justify-between items-center w-50 h-28 bg-white rounded-2xl p-4 text-left font-semibold text-sc-almost-black" style="line-height: 1.2;">
            <div
                class="absolute top-4 right-3 flex justify-center items-center text-center text-[14px] cursor-pointer">
                <img src="icons/headphone.png" alt="наушники" class="w-10 h-10">
            </div>
            <div class="mt-auto">Пройти обучение и сдать тест</div>
        </div>
    </div>
    {{--    <div class="mt-2.5 p-4 rounded-xl bg-sc-white-32 flex flex-col border-sc-border border-[2px]">--}}
    {{--        <div class="flex justify-between items-center">--}}
    {{--            <div class="text-[16px] text-sc-gray-text font-semibold">Выйти из аккаунта</div>--}}
    {{--            <div class="text-[14px] text-sc-gray-text">→</div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</div>
