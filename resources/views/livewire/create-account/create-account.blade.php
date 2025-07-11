<div class="h-[80vh] bg-white rounded-[28px] w-full">
    <div class="h-[80vh] flex flex-col border-[1px] border-sc-border rounded-[28px] pb-[8px]">
        <div class="flex flex-row">
            <div class="flex flex-col mt-[24px] ml-[24px]">
                <span class="text-base text-[16px] font-medium font-MontserratBold text-sc-almost-black"> Регистрация </span>
                <span class="font-semibold font-MontserratBold text-[24px] text-sc-almost-black"> Аккаунта </span>
            </div>
            <div wire:click="redirectToLogin" class="w-[23px] h-[23px] bg-[url('/images/exit.png')] place-self-start mt-[32px] cursor-pointer">
                <button class=""></button>
            </div>
            <div> {{-- TEST - WAITING FOR REMOVE--}}
{{--                <button onclick="{alert(window.Telegram.WebApp.platform)}">Тест ТГ</button>--}}
                <button onclick="{
                    const data = JSON.parse(new URLSearchParams(window.Telegram.WebApp.initData).get('user'))
                    alert(data.username)
                }">Тест ТГ</button>
                <button onclick="{
                    const data = JSON.parse(new URLSearchParams(window.Telegram.WebApp.initData).get('user'))
                    alert(data.language_code)
                }">Язык</button>
                <button onclick="{alert(window.Telegram.WebApp.close())}">Закрыть</button>
            </div>
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
        <form wire:submit="store" class="bg-white ml-8 mr-8">
            <div class="rounded-[20px] border-[1px] border-sc-border pb-[8px] border-opacity-80">
                <div class="form-div">
                    <span class="form-span"> Ваше ФИО </span>
                    <input wire:model="fio" type="text" class="form-input" name="fio" placeholder="Фамилия Имя Отчество*" required/>
                    @error('fio') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-div">
                    <span class="form-span"> Номер телефона </span>
                    <input wire:model="phone" type="phone" class="form-input" name="phone" placeholder="+7 (Номер телефона)" required />
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-div">
                    <span class="form-span"> Ваш регион </span>
                    <input wire:model="region" type="text" class="form-input" name="region" placeholder="Россия, (Регион)" />
                    @error('region') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-div">
                    <span class="form-span"> Ваш пароль </span>
                    <input wire:model="password" type="password" class="form-input" name="password" placeholder="Пароль" required />
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-div">
                    <span class="form-span"> Повторите пароль </span>
                    <input wire:model="password_confirmation" type="password" class="form-input" name="password_confirmation" placeholder="Пароль" required />
                    @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="checkbox">
                <span for="newsletter">Оставаться в системе</span>
                <input wire:model="is_leave" type="checkbox"
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
            <input class="bg-sc-yellow w-full mt-[20px] rounded-[20px] h-[64px] cursor-pointer" type="submit" value="Зарегистрироваться">
        </form>
        <div class="exist h-[80vh] w-full">
            <span class="text-sc-gray-text"> Есть аккаунт?
            <a href="/login" class="text-sc-check font-Montserrat"> Войдите</a>
            </span>
        </div>
    </div>
</div>


