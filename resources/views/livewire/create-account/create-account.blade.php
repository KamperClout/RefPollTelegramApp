<div class="bg-sc-main-font pt-[66px] pr-[8px] pb-[24px] pl-[8px] max-w-screen-Android h-[800px] rounded-[36px] font-Montserrat">
    <div class="bg-white rounded-[28px] h-[668px] w-[344px]">
        <div class="flex flex-col border-[1px] border-sc-border pb-[8px] h-[668px]">
            <div class="flex flex-col mt-[24px] ml-[24px]">
                <span class="text-black text-base"> Регистрация </span>
                <span class="text-black font-MontserratBold text-lg"> Аккаунта </span>
            </div>
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
            <form wire:submit="store" class="bg-white ml-8 mr-8 mt-24  ">
                <div class="rounded-[20px] border-[1px] border-sc-border pb-[8px]">
                    <div class="form-div">
                        <span class="form-span"> Ваше ФИО </span>
                        <input wire:model="fio" type="text" name="fio" placeholder="Фамилия Имя Отчество*" required/>
                        @error('fio') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-div">
                        <span class="form-span"> Номер телефона </span>
                        <input wire:model="phone" type="phone" name="phone" placeholder="+7(Номер телефона)" required />
                        @error('phone') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-div">
                        <span class="form-span"> Ваш регион </span>
                        <input wire:model="region" type="text" name="region" placeholder="Россия, (Регион)" />
                        @error('region') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-div">
                        <span class="form-span"> Ваш пароль </span>
                        <input wire:model="password" type="password" name="password" placeholder="Пароль" required />
                        @error('password') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-div">
                        <span class="form-span"> Повторите пароль </span>
                        <input wire:model="password_confirmation" type="password" name="password_confirmation" placeholder="Пароль" required />
                        @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="checkbox">
                    <span for="newsletter">Оставаться в системе</span>
                    <input wire:model="is_leave" type="checkbox"
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
                <input class="button" type="submit" value="Зарегистрироваться">

            </form>
            <div class="exist">
                <span class="text-sc-gray-text"> Есть аккаунт?
                <a class="text-sc-check font-Montserrat"> Войдите</a>
                </span>
            </div>
        </div>
    </div>
</div>
