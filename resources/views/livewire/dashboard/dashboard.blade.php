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
{{--    тут нужен скрол--}}
    <div class="flex flex-row">
        <div class="flex flex row">
            <div class="w-[40px] h-[40px] bg-white rounded-[12px] border-[1px] border-sc-border p-[12px]">
                <div class="w-[16px] h-[16px] bg-[url('/images/presention-chart.png')]"> </div>
            </div>
            <span class="ml-[16px] mt-[10px]"> Статистика </span>
        </div>
        {{--    тут нужен ml-[38px]--}}
        <div class="flex flex row ml-[18px]">
            <div class="w-[40px] h-[40px] bg-white rounded-[12px] border-[1px] border-sc-border p-[12px]">
                <div class="w-[16px] h-[16px] bg-[url('/images/document-text.png')]"> </div>
            </div>
            <span class="ml-[16px] mt-[10px]"> Выписки и справки </span>
        </div>
    </div>
    <div class="mt-[] bg-"> </div>
    <div>
        <select wire:model="sortSelected" wire:change="sortBy()">
            <option value="createdAt asc">Последние Транзакции</option>
            <option value="createdAt desc">Старые Транзакции</option>
        </select>
    </div>
    <div>
        @foreach ($paymentDTOs as $date => $payments)
            <h2>{{ $formatDate($date) }}</h2>
            @foreach ($payments as $index => $payment)
                @if ($loop->first || $loop->last)
                    <div style="background-color: green;">
                        <div>
                            {{ $payment['surname'] }} {{ $payment['name'] }}
                        </div>
                        <div>
                            {{'+ ' . $payment['amount'] }}
                        </div>
                    </div>
                @else
                    <div style="background-color: gray;">
                        <div>
                            {{ $payment['surname'] }} {{ $payment['name'] }}
                        </div>
                        <div>
                            {{ $payment['amount'] }}
                        </div>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
</div>
