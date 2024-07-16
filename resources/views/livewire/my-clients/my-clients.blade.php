<div>
    @if (!$showForm)
        <div class="w-[344px] h-[212px] bg-white bg-opacity-80 rounded-[28px] border-[1px] border-sc-border flex flex-col mt-[26px]">
            <div class="flex flex-col mt-[32px] ml-[24px]">
                <span class="text-base text-[16px] font-medium font-MontserratBold text-sc-almost-black"> Мои </span>
                <span class="font-semibold font-MontserratBold text-[24px] text-sc-almost-black"> Клиенты </span>
            </div>
            <div class="flex flex row">
                <div class="w-[160px] h-[103px] bg-sc-check rounded-[20px] ml-[8px] mt-[20px] border-sc-check border-[2px] flex flex-col">
                    <span class="w-[97px] h-[13px] font-medium font-Montserrat text-white text-[14px] ml-[17px] mt-[10px]"> Оплатившие </span>
                    <span class="font-Montserrat text-white text-[36px] ml-[17px] mt-[3px]"> {{ $paidCount }} </span>
                </div>
                <div class="w-[160px] h-[103px] bg-sc-white rounded-[20px] ml-[8px] mt-[20px] border-sc-form border-[2px] flex flex-col">
                    <span class="w-[97px] h-[13px] font-medium font-Montserrat text-sc-almost-black text-[14px] ml-[17px] mt-[10px]">Всего</span>
                    <span class="font-Montserrat text-sc-check text-[36px] ml-[17px] mt-[3px]">{{ $unpaidCount }}</span>
                </div>
            </div>
        </div>
        <div class="w-[344px] h-[450px] bg-white bg-opacity-80 rounded-[20px] border-[1px] border-sc-border flex flex-col mt-[8px]">
            <div class="fixed top-[332px] left-[29px] w-[16px] h-[16px] bg-[url('/images/search-normal.png')]"> </div>
            <input type="text" wire:model.lazy="search" class="w-[328px] h-[40px] border rounded-[12px] mt-[8px] ml-[8px] bg-sc-form-back mb-[4px]" placeholder=""/>
            @foreach($clients as $client)
                @if (!$client->is_payment)
                    <div class="w-[328px] h-[64px] bg-white rounded-[20px] mt-[4px] border-[1px] border-sc-border border-opacity-80 ml-[8px] flex flex-row">
                        <div class="w-[48px] h-[48px] bg-white rounded-[12px] border-[1px] border-sc-border ml-[8px] mt-[8px] pl-[17px] pt-[10px]">
                            {{ $loop->iteration }}
                        </div>
                        <div class="flex flex-col ml-[16px] mt-[9px]">
                            <span class="text-sc-almost-black text-[13px] font-Montserrat font-medium"> {{ $client->surname}} {{ $client->name }}</span>
                            <span class="text-sc-check">  {{ $client->phone }} </span>
                        </div>
                    </div>
                @endif
            @endforeach
            <button wire:click="openForm" class="w-[64px] h-[64px] rounded-[20px] fixed top-[720px] left-[280px] bg-sc-yellow text-sc-almost-black text-[36px]">
                +
            </button>
        </div>
    @else
        @if (session()->has('success'))
            <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif
        <form wire:submit="addClient">
            <button wire:click="closeForm">
                +
            </button>
            <div>
                <span > Ваше ФИО </span>
                <input wire:model="form.fio" type="text" name="fio" placeholder="Фамилия Имя Отчество*" required/>
                @error('form.fio') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <span > Ваш телефон </span>
                <input wire:model="form.phone" type="tel" name="phone" placeholder="Телефон" required/>
                @error('form.phone') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <span > Ваш регион </span>
                <input wire:model="form.region" type="text" name="region" placeholder="Регион" required/>
                @error('form.region') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="checkbox">
                <span for="newsletter">Наличие залога</span>
                <input wire:model="form.deposit" type="checkbox"
                       class="ml-[117px]
                        relative
                        appearance-none
                        inline block
                        h-[20px] w-[30px]
                        cursor-pointer
                        rounded-[8px]
                        border-sc-check
                        bg-sc-check
                        after:absolute
                        after:-top-[-4px]
                        after:-left-[-4px]
                        after:h-[12px]
                        after:w-[12px]
                        after:translate-x-0
                        after:rounded-[4px]
                        after:border-[3px]
                        after:border-white
                        after transition-all
                        after:bg-white
                        checked:border-sc-check
                        checked:after:translate-x-[10px]
                        checked:after:border-white">
            </div>
            <div>
                <input wire:model="form.debt_amount" id="radio-1" type="radio" name="radio" value="< 100 т. р." checked>
                <label for="radio-1">< 100 т. р.</label>
            </div>

            <div>
                <input wire:model="form.debt_amount" id="radio-2" type="radio" name="radio" value="100 - 200 т. р.">
                <label for="radio-2">100 - 200 т. р.</label>
            </div>

            <div>
                <input wire:model="form.debt_amount" id="radio-3" type="radio" name="radio" value="200 - 300 т. р.">
                <label for="radio-3">200 - 300 т. р.</label>
            </div>

            <div>
                <input wire:model="form.debt_amount" id="radio-4" type="radio" name="radio" value="300 - 400 т. р.">
                <label for="radio-4">300 - 400 т. р.</label>
            </div>
            <div>
                <input wire:model="form.debt_amount" id="radio-5" type="radio" name="radio" value="400 - 500 т. р.">
                <label for="radio-5">400 - 500 т. р.</label>
            </div>
            <div>
                <input wire:model="form.debt_amount" id="radio-6" type="radio" name="radio" value="> 500 т. р.">
                <label for="radio-6">> 500 т. р.</label>
            </div>
            @error('form.debt_amount') <span class="error">{{ $message }}</span> @enderror
            <input type="submit" class="cursor-pointer" value="Добавить клиента">
        </form>

    @endif
</div>
