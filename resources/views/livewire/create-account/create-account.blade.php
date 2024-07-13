<div class="bg-blue-variant-main-font pt-66 pr-8 pb-66 pl-8 max-w-screen-Android rounded-36 font-Manrope">
    <div class="bg-blue-variant-font rounded-28 ">
        <div class="flex flex-col">
            <div class="pt-24 pl-24 pr-200">
                <span class="text-black"> Регистрация </span>
                <span class="text-black"> аккаунта </span>
            </div>
            <form wire:submit="store" class="rounded-20 bg-white ml-8 mr-8 mt-24">
                <div class=" flex flex-col mt-16 ml-8 mr-8">
                    <span class="text-blue-variant-gray-text"> Ваше ФИО </span>
                    <input type="text" wire:model="fio" name="fio" placeholder="Фамилия Имя Отчество*"
                           class="bg-blue-variant-form-back text-blue-variant-gray-text rounded-12 h-40 pl-15"
                           required/>
                    @error('fio') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="">
                    <input type="text" wire:model="phone" name="phone" placeholder="+7(Номер телефона)" required/>
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="">
                    <input type="text" wire:model="region" name="region" placeholder="Россия, (Регион)" required/>
                    @error('region') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="">
                    <input type="password" wire:model="password" name="password" placeholder="Пароль" required/>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="">
                    <input type="password" wire:model="password_confirmation" name="password_confirmation"
                           placeholder="Пароль" required/>
                    @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
                </div>
                {{--                <input class="button bg-blue-variant-yellow" type="submit" value="Сережа, это кнопка, честно">--}}
                <button type="submit">
                    Add user
                </button>
            </form>
        </div>
    </div>
</div>
