<div class="bg-custom rounded-3xl p-3 min-h-screen max-w-full overflow-x-hidden flex flex-col pb-[56px]">
    <div class="flex justify-between items-center mb-4">
        <div style="line-height: 0.8;">
            <p class="text-sc-almost-black font-medium text-[15px]">мои</p>
            <p class="text-[24px] font-semibold text-sc-almost-black">анкеты</p>
        </div>
        <div class="flex items-center justify-center gap-3 cursor-pointer relative">
            <div wire:navigate
                 href="{{ route('main-page') }}"
                 class="w-10 h-10 bg-white rounded-[12px] flex items-center justify-center">
                <img src="icons/home-2.png" alt="Главная" class="w-6 h-6"/>
            </div>
        </div>
    </div>

    {{--@if (!$showForm)--}}
    <div class="mt-8 p-3 rounded-2xl bg-white">
        <div class="mt-2">
            <p class="font-semibold text-sc-gray-text text-[16px]">
                Список
            </p>
            <p class="font-semibold text-sc-almost-black text-[20px]">
                Анкет
            </p>
        </div>
        <div class="relative w-full mt-3">
            <div class="absolute left-[29px] top-2 w-[16px] h-[16px] bg-[url('/images/search-normal.png')]"></div>
            <input wire:model.lazy="search" type="text"
                   class="w-full h-[40px] rounded-[12px] bg-gray-200 mb-[4px] pl-12 border-none"
                   placeholder="Поиск по анкетам"/>
            <div class="client-list-container">
                @foreach($answeredAnketas as $answ)
                    <div
                        class="w-full h-[70px] bg-white rounded-[20px] mt-2 border-[2px] border-sc-border border-opacity-95 ml-[2px] flex flex-row items-center">
                        <div
                            class="w-[48px] h-[48px] bg-white rounded-[12px] border-[1px] border-sc-border ml-2 flex items-center justify-center">
                            @if($answ->status == "Одобрено")
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @elseif($answ->status == "Отклонено")
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            @else
                                <svg viewBox="0 0 20 20" width="24" height="24">
                                    <text x="10" y="16" style="color: #e8bb27" font-family="Arial" font-size="16" text-anchor="middle" fill="currentColor">?</text>
                                </svg>
                            @endif
                        </div>
                        <div class="flex flex-col ml-3">
                            <span
                                class="text-sc-almost-black text-[16px] font-semibold break-words"> {{$answ->anketa->name}} </span>
                            <span class="text-sc-gray-text text-[14px] break-words">
            {{$answ->status}},
            <time datetime="{{ $answ->updated_at->toIso8601String() }}" class="utc-to-local-pretty">
                {{ $answ->updated_at->format('Y-m-d H:i:s') }} UTC
            </time>
            @if($answ->is_referral)
                                    <span class="block text-[12px] text-sc-check">Заполнена по ссылке</span>
                                @endif
        </span>
                        </div>
                    </div>
                @endforeach
                <script>
                    function formatPrettyDate(date) {
                        const now = new Date();
                        const diffDays = Math.floor((now - date) / (1000 * 60 * 60 * 24));

                        if (diffDays === 0) {
                            return 'Сегодня в ' + date.toLocaleTimeString('ru-RU', {
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                        } else if (diffDays === 1) {
                            return 'Вчера в ' + date.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit'});
                        } else {
                            return date.toLocaleDateString('ru-RU', {day: 'numeric', month: 'long'}) +
                                ' в ' + date.toLocaleTimeString('ru-RU', {hour: '2-digit', minute: '2-digit'});
                        }
                    }

                    document.querySelectorAll('.utc-to-local-pretty').forEach(el => {
                        const utcDate = new Date(el.getAttribute('datetime'));
                        el.textContent = formatPrettyDate(utcDate);
                    });
                </script>
            </div>
        </div>
        <div class="mt-4">
            {{ $answeredAnketas->links('pagination::tailwind') }}
        </div>
        {{--            @dump($answeredAnketas)--}}
    </div>
    {{--           <div class="search">--}}
    {{--                <img src="https://image.flaticon.com/icons/svg/49/49116.svg" alt="" class="search-icon">--}}
    {{--                <input wire:model.lazy="search" type="text" class="search-field" placeholder="">--}}
    {{--            </div>--}}
   {{-- <button wire:click="openForm"
            class="w-[64px] h-[64px] rounded-[20px] fixed bottom-20 right-6 bg-sc-yellow text-sc-almost-black text-[36px]">
        +
    </button>--}}
    {{-- @else
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
             <div
                 class="w-[344px] h-[690px] bg-white bg-opacity-80 rounded-[28px] border-[1px] border-sc-border flex flex-col mt-[15px]">
                 <div class="flex flex-row">
                     <div class="flex flex-col mt-[24px] ml-[24px]">
                         <span
                             class="text-base text-[16px] font-medium font-MontserratBold text-sc-almost-black"> Новый </span>
                         <span class="font-semibold font-MontserratBold text-[24px] text-sc-almost-black"> Клиент </span>
                     </div>
                     <div class="">
                         <button class="w-[23px] h-[23px] bg-[url('/images/exit.png')] ml-[170px] mt-[32px]"
                                 wire:click="closeForm"></button>
                     </div>
                 </div>
                 <div
                     class=" w-[328px] h-[247px] bg-white bg-opacity-80 rounded-[28px] border-[1px] border-sc-border flex flex-col mt-[15px]">
                     <div class="form-div">
                         <span class="form-span"> ФИО  Клиента </span>
                         <input wire:model="form.fio" class="form-input" type="text" name="fio"
                                placeholder="Фамилия Имя Отчество*" required/>
                         @error('form.fio') <span class="error">{{ $message }}</span> @enderror
                     </div>
                     <div class="form-div">
                         <span class="form-span"> Телефон Клиента </span>
                         <input wire:model="form.phone" class="form-input" type="tel" name="phone"
                                placeholder="+7 (Номер телефона)" required/>
                         @error('form.phone') <span class="error">{{ $message }}</span> @enderror
                     </div>
                     <div class="form-div">
                         <span class="form-span"> Регион Клиента</span>
                         <input wire:model="form.region" class="form-input" type="text" name="region"
                                placeholder="Россия, (Регион)" required/>
                         @error('form.region') <span class="error">{{ $message }}</span> @enderror
                     </div>
                 </div>
                 <div
                     class="w-[328px] h-[56px] bg-white bg-opacity-80 rounded-[28px] border-[1px] border-sc-border flex flex-row mt-[4px] pt-[17px] pl-[16px]">
                     <span for="newsletter"
                           class="font-Montserrat font-medium text-sc-almost-black">Наличие залога</span>
                     <div class="">
                         <input wire:model="form.deposit" type="checkbox"
                                class="ml-[156px]
                         relative
                         appearance-none
                         inline block
                         h-[20px] w-[30px]
                         cursor-pointer
                         rounded-[8px]
                         border-sc-border
                         bg-sc-border
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
                         checked:bg-sc-check
                         checked:border-sc-check
                         checked:after:translate-x-[10px]
                         checked:after:border-white">
                     </div>
                 </div>
                 <div
                     class="w-[328px] h-[184px] bg-white bg-opacity-80 rounded-[20px] border-[1px] border-sc-border flex flex-col mt-[4px] pt-[17px] pl-[8px]">
                     <span class="font-Montserrat font-medium text-sc-almost-black mb-[8px] ml-[7px]"> Сумма долга</span>
                     <div class="flex flex-row">
                         <div class="flex flex-col">
                             <div class="form_radio_btn">
                                 <input wire:model="form.debt_amount" id="radio-1" type="radio" name="radio"
                                        value="< 100 т. р.">
                                 <label for="radio-1">< 100 т. р.</label>
                             </div>
                             <div class="form_radio_btn">
                                 <input wire:model="form.debt_amount" id="radio-3" type="radio" name="radio"
                                        value="200 - 300 т. р.">
                                 <label for="radio-3">200 - 300 т. р.</label>
                             </div>
                             <div class="form_radio_btn">
                                 <input wire:model="form.debt_amount" id="radio-5" type="radio" name="radio"
                                        value="400 - 500 т. р.">
                                 <label for="radio-5">400 - 500 т. р.</label>
                             </div>
                         </div>
                         <div class="flex flex-col">
                             <div class="form_radio_btn ml-[4px]">
                                 <input wire:model="form.debt_amount" id="radio-2" type="radio" name="radio"
                                        value="100 - 200 т. р.">
                                 <label for="radio-2">100 - 200 т. р.</label>
                             </div>
                             <div class="form_radio_btn ml-[4px]">
                                 <input wire:model="form.debt_amount" id="radio-4" type="radio" name="radio"
                                        value="300 - 400 т. р.">
                                 <label for="radio-4">300 - 400 т. р.</label>
                             </div>
                             <div class="form_radio_btn ml-[4px]">
                                 <input wire:model="form.debt_amount" id="radio-6" type="radio" name="radio"
                                        value="> 500 т. р.">
                                 <label for="radio-6"> > 500 т. р.</label>
                             </div>
                         </div>
                     </div>
                     @error('form.debt_amount') <span class="error">{{ $message }}</span> @enderror
                 </div>
                 <input type="submit" class="button ml-[8px] cursor-pointer" value="Добавить клиента">
             </div>
         </form>
     @endif--}}
</div>
</script>
