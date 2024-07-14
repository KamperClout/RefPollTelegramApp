<div class="big-div">
    <div class="bg-white rounded-[28px] w-[344px] h-[466px] mt-[166px] mb-[168px] border-[1px] border-sc-border">
        <div class="flex flex-col mt-[24px] ml-[24px]">
            <span class="text-black text-base"> Войти в </span>
            <span class="text-black font-MontserratBold text-lg"> Аккаунт </span>
        </div>
        <form class="bg-white ml-8 mr-8 mt-24 ">
            <div class="rounded-[20px] border-[1px] border-sc-border pb-[8px] border-opacity-80">
                <div class="form-div">
                    <span class="form-span"> Номер телефона </span>
                    <input type="phone" class="form-input" name="phone" placeholder="+7 (Номер телефона)" required />
{{--                    @error('phone') <span class="error">{{ $message }}</span> @enderror--}}
                </div>
                <div class="form-div">
                    <span class="form-span"> Ваш пароль </span>
                    <input type="password" class="form-input" name="password" placeholder="Пароль" required />
{{--                    @error('password') <span class="error">{{ $message }}</span> @enderror--}}
                </div>
            </div>
            <div class="checkbox">
                <span for="newsletter">Оставаться в системе</span>
                <input type="checkbox"
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
            <input class="button" type="submit" value="Войти">
        </form>
        <div class="flex flex-row ml-[63px] mt-[16px] mb-[24px]">
                <span class="text-sc-gray-text"> Нет аккаунта?
                <a class="text-sc-check font-Montserrat"> Зарегистрируйтесь</a>
                </span>
        </div>
    </div>
</div>
