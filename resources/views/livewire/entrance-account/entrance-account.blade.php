
    <div class="bg-white rounded-[28px] w-full border-[1px] border-sc-border">
        <div class="flex flex-col mt-[24px] ml-[24px]">
            <span class="text-base text-[16px] font-medium font-MontserratBold text-sc-almost-black"> Войти в </span>
            <span class="font-semibold font-MontserratBold text-[24px] text-sc-almost-black"> Аккаунт </span>
        </div>
        @if (session()->has('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded">
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="bg-red-200 text-red-800 p-2 rounded">
                {{ session('error') }}
            </div>
        @endif
        <form wire:submit="login" class="bg-white ml-8 mr-8">
            <div class="rounded-[20px] border-[1px] border-sc-border pb-[8px] border-opacity-80">
                <div class="form-div">
                    <span class="form-span"> Номер телефона </span>
                    <input wire:model="phone" type="phone" class="form-input" name="phone" placeholder="+7 (Номер телефона)" required />
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-div">
                    <span class="form-span"> Ваш пароль </span>
                    <input wire:model="password" type="password" class="form-input" name="password" placeholder="Пароль" required />
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end pr-[8px]">
                    <a href="/recovery" class="text-sc-check font-Montserrat h-[15px] ">Забыли пароль?</a>
                </div>
            </div>
            <div class="checkbox">
                <span for="newsletter">Оставаться в системе</span>
                <div class="">
                    <input wire:model="remember" type="checkbox"
                           class="
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
            <input class="bg-sc-yellow w-full mt-[20px] rounded-[20px] h-[64px] text-sc-almost-black font-MontserratBold cursor-pointer" type="submit" value="Войти">
        </form>
        <div class="flex flex-row mt-[16px] mb-[24px] w-full justify-center">
                <span class="text-sc-gray-text"> Нет аккаунта?
                <a href="/register" class="text-sc-check font-Montserrat"> Зарегистрируйтесь</a>
                </span>
        </div>
    </div>

