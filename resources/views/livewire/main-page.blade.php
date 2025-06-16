<div class="p-3 max-w-full overflow-x-hidden">
    <div class="flex justify-between items-center mb-4">
        <div style="line-height: 0.8;">
            <p class="text-sc-almost-black font-medium text-[15px]">добро
{{--                TG-{{$tgid}}--}}
            </p>
            <p class="text-[24px] font-semibold text-sc-almost-black"
{{--               wire:click="clear"--}}
            >пожаловать!
{{--                Id - {{$id}}--}}
            </p>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-2 h-25">
        <div class="p-3 rounded-2xl flex flex-col"
             style="background: linear-gradient(to bottom, #F6F8F7 25%, rgba(254, 229, 90, 0.3) 80%)">
            <div class="font-semibold text-[14px] text-sc-almost-black">Действий</div>
            <div class="text-sm text-sc-almost-black">для перехода</div>
            <div class="text-sm text-sc-almost-black">на след.ур.</div>
            <div class="bg-white rounded-2xl text-[14px] font-semibold text-sc-almost-black text-center mt-auto">{{10 - $progress%10}}</div>
        </div>
        <div class="p-3 rounded-2xl flex flex-col"
             style="background: linear-gradient(to bottom, #F6F8F7 25%, rgba(254, 229, 90, 0.3) 80%)">
            <div class="font-semibold text-[14px] text-sc-almost-black">Прибыль</div>
            <div class="text-sm text-sc-almost-black">за действие</div>
            <div class="text-sm text-sc-almost-black">старт</div>
            <div class="bg-white rounded-2xl text-[14px] font-semibold text-sc-almost-black text-center mt-auto">+120₽
            </div>
        </div>
        <div class="p-3 rounded-2xl flex flex-col"
             style="background: linear-gradient(to bottom, #F6F8F7 25%, rgba(113, 182, 112, 0.3) 80%)">
            <div class="font-semibold text-[14px] text-sc-almost-black">Прибыль</div>
            <div class="text-sm text-sc-almost-black">с партнеров</div>
            <div class=" bg-white rounded-2xl text-[14px] font-semibold text-sc-check text-center mt-5">+{{$fromFriends}}₽</div>
        </div>
    </div>

    <div class="mt-3 rounded-2xl p-3 flex flex-col"
         style="background: rgba(255, 255, 255, 0.64);">
        <div
            class="flex justify-between border-sc-border border-[2px] rounded-2xl border-opacity-60 items-center px-3 py-1.5 mb-3">
            <div class="flex items-center justify-center">
                <div class="font-semibold ">Уровень</div>
                <div class="font-semibold ml-2 rounded-2xl bg-sc-almost-black w-12 text-sc-main-font text-center">{{intdiv($progress,10)+1}}
                </div>
            </div>
            <div class="font-semibold rounded-2xl border-sc-almost-black border-[2px] w-12 text-center">{{(intdiv($progress,10)+2)}}</div>
        </div>
        <livewire:progress-circle :current-level="$progress%10" :next-level="10"/>
    </div>
    <div class="mt-2.5 p-3 rounded-2xl bg-white flex flex-col">
        <div class="flex justify-between items-center">
            <div class="text-[32px] text-sc-almost-black font-semibold">₽ {{$balance}}</div>
            <div class="text-[16px] text-sc-almost-black font-semibold">cчет</div>
        </div>
        <div class="flex justify-between rounded-2xl border-[1px] border-sc-border py-1 px-3 w-full items-center">
            <div class="text-[14px]">Всего</div>
            <div class="text-[14px] font-semibold">{{(intdiv($progress,10)+1)*5000}}₽</div>
        </div>
    </div>
{{--    <div wire:click="deposit">Test(Пополнить на 500)</div>--}}
{{--    <div wire:click="withdraw">Test(Списать 500)</div>--}}
{{--@dump()--}}
</div>
