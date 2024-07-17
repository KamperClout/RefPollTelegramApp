<div>
    <div class="w-[344px] h-[164px] rounded-[28px] flex flex-col
    border-[1px] border-sc-border bg-white mt-[16px]">
        <div class="flex flex-row">
            <div class="flex flex-col mt-[24px] ml-[24px]">
                <div class="text-base text-[16px] font-medium font-MontserratBold text-sc-almost-black">Мои</div>
                <div class="font-semibold font-MontserratBold text-[24px] text-sc-almost-black">Выплаты</div>
                <div class="flex flex-row">
                    <div class="text-sc-check font-semibold font-Montserrat text-[33px]">{{'₽' . ' ' . $rubles}}</div>
                    <div class="text-sc-check font-semibold font-Montserrat text-[16px] mt-[7px]">{{'.' . $copecks}}</div>
                </div>
            </div>
            <button class="w-[40px] h-[40px] bg-[url('/images/down.png')] ml-[140px] mt-[19px]"></button>
        </div>
    </div>
    <div class="flex flex-row " style="overflow-x: auto; max-height: 60px;">
        <div class="flex flex-row items-center">
            <div class="w-[40px] h-[40px] bg-white rounded-[12px] border-[1px] border-sc-border p-[12px]">
                <div class="w-[16px] h-[16px] bg-[url('/images/presention-chart.png')]"> </div>
            </div>
            <span class="ml-[16px] mt-[10px] h-[16px]"> Статистика </span>
        </div>
        <div class="flex flex-row items-center">
            <div class="w-[40px] h-[40px] bg-white rounded-[12px] border-[1px] border-sc-border p-[12px]">
                <div class="w-[16px] h-[16px] bg-[url('/images/document-text.png')]"> </div>
            </div>
            <span class="ml-[16px] mt-[10px] h-[16px]"> Выписки и справки </span>
        </div>
    </div>

{{--    <div class="mt-[15px] ml-[121px]">--}}
{{--        <div class="--}}
{{--            relative--}}
{{--            appearance-none--}}
{{--            inline block--}}
{{--            w-[120px] h-[4px]--}}
{{--            cursor-pointer--}}
{{--            border-sc-scroll--}}
{{--            bg-sc-scroll--}}
{{--            after:absolute--}}
{{--            after:-top-[-4px]--}}
{{--            after:-left-[-4px]--}}
{{--            after:h-[4px]--}}
{{--            after:w-[33.24px]--}}
{{--            after:translate-x-0--}}
{{--            after:rounded-[4px]--}}
{{--            after:border-[3px]--}}
{{--            after:border-white--}}
{{--            after transition-all--}}
{{--            after:bg-sc-check--}}
{{--            checked:after:translate-x-[10px]--}}
{{--            ">--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="bg-sc-main-font text-sc-gray-text">
        <select wire:model="sortSelected" wire:change="sortBy()" class="bg-sc-main-font mt-[29px]">
            <option value="createdAt asc">Последние Транзакции</option>
            <option value="createdAt desc">Старые Транзакции</option>
        </select>
    </div>
    <div class="w-[344px] h-[400px] bg-white bg-opacity-80 rounded-[28px] border-[1px] border-sc-border flex flex-col">
        <div style="max-height: 410px; overflow-y: auto;">
            @foreach ($paymentDTOs as $date => $payments)
                <div>
                    <div class="text-[14px] font-Montserrat font-semibold text-sc-almost-black mt-[16px] ml-[16px]">
                        {{ $formatDate($date) }}
                    </div>

                    @foreach ($payments as $index => $payment)
                        @if ($loop->first || $loop->last)
                            <div class="w-[328px] h-[70px] bg-white bg-opacity-80 rounded-[20px] border-[1px] border-sc-border mt-[4px]">
                                <div class="flex flex-row w-[312px] h-[40px] bg-sc-check rounded-[12px] mt-[19px]">
                                    <div class="text-white ml-[22px] mt-[11px]">
                                        {{ $payment['surname'] }} {{ $payment['name'] }}
                                    </div>
                                    <div class="bg-white text-sc-check w-[92px] h-[30px] rounded-[8px] ml-[100px] mt-[5px] pl-[3px] pt-[3px]">
                                        {{'+ ' . $payment['amount'] }}
                                    </div>
                                </div>

                            </div>
                        @else
                            <div class="w-[328px] h-[70px] bg-white bg-opacity-80 rounded-[20px] border-[1px] border-sc-border mt-[4px]">
                                <div class="flex flex-row w-[312px] h-[40px] bg-white border-sc-scroll rounded-[12px]  mt-[19px]">
                                    <div  class="text-sc-gray-text ml-[22px] mt-[11px] flex flex-row">
                                        {{ $payment['surname'] }}
                                        {{ $payment['name'] }}
                                    </div>
                                    <div class="border-sc-scroll bg-white border-[1px] text-sc-gray-text w-[92px] h-[30px] rounded-[8px] ml-[100px] pl-[3px] pt-[3px]">
                                        {{ $payment['amount'] }}
                                    </div>
                                </div>

                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>

    </div>
</div>
