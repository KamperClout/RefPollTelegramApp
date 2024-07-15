<div class="container mx-auto">
    @if (!$showForm)
        <h1 class="text-2xl font-bold text-blue-variant-gray-text">Welcome to your MyClients!</h1>
        <p class="mt-4 text-blue-variant-font">This is the my-clients page.</p>
        <div>
            <p>Всего оплативших: {{ $paidCount }}</p>
            <p>Всего не оплативших: {{ $unpaidCount }}</p>
        </div>
        <div class="mt-4">
            <input type="text" wire:model.lazy="search" class="border rounded p-2" placeholder=""/>
        </div>
        @foreach($clients as $client)
            @if (!$client->is_payment)
                <div>
                    {{ $loop->iteration }}. {{ $client->name }} {{ $client->surname }} {{ $client->patronymic }} - {{ $client->phone }}
                </div>
            @endif
        @endforeach
        <button wire:click="openForm">
            +
        </button>
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
