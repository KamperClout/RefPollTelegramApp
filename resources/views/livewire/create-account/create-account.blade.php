<div class="bg-sc-main-font pt-66 pr-8 pb-66 pl-8 max-w-screen-Android rounded-36 font-Montserrat">
    <div class="bg-white rounded-28 ">
        <div class="flex flex-col border-2 border-sc-border">
            <div class="flex flex-col mt-24 ml-24">
                <span class="text-black"> Регистрация </span>
                <span class="text-black"> аккаунта </span>
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
            <form wire:submit="store" class="rounded-20 bg-white ml-8 mr-8 mt-24 border-2 border-sc-border pb-8">
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

                <div class="checkbox">
                    <label for="newsletter">Оставаться в системе</label>
                    <input wire:model="is_leave" type="checkbox" id="NoLeave" class="check-input">
                </div>
                <input class="button" type="submit" value="Зарегистрироваться">
            </form>
        </div>
    </div>
</div>
