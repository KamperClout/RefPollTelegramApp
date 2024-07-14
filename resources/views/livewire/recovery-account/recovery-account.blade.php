{{--<div class="big-div">--}}
{{--    <div class="bg-white rounded-[28px] w-[344px] h-[293px] mt-[253px] mb-[254px] border-[1px] border-sc-border">--}}
{{--        <div class="flex flex-col mt-[24px] ml-[24px]">--}}
{{--            <span class="text-black text-base"> Восстановление </span>--}}
{{--            <span class="text-black font-MontserratBold text-lg"> Аккаунта </span>--}}
{{--        </div>--}}
{{--        <form class="bg-white ml-8 mr-8 mt-24 ">--}}
{{--            <div class="rounded-[20px] border-[1px] border-sc-border pb-[8px] border-opacity-80">--}}
{{--                <div class="flex flex-col mt-[24px] ml-[8px] mr-[8px] size-[15.02]">--}}
{{--                    <span class="form-span"> Номер телефона </span>--}}
{{--                    <input type="phone" class="form-input" name="phone" placeholder="+7 (Номер телефона)" required />--}}
{{--                                        @error('phone') <span class="erro r">{{ $message }}</span> @enderror--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <input class="button" type="submit" value="Отправить код по смс">--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="big-div">
    <div class="bg-white rounded-[28px] w-[344px] h-[293px] mt-[253px] mb-[254px] border-[1px] border-sc-border">
        <div class="flex flex-col mt-[24px] ml-[24px]">
            <span class="text-black text-base"> Восстановление </span>
            <span class="text-black font-MontserratBold text-lg"> Аккаунта </span>
        </div>
        <form class="bg-white ml-8 mr-8 mt-24 ">
            <div class="rounded-[20px] border-[1px] border-sc-border pb-[8px] border-opacity-80">
                <div class="flex flex-col mt-[24px] ml-[8px] mr-[8px] size-[15.02]">
                    <span class="form-span"> Код СМС </span>
                    <input type="text" class="form-input" name="phone" placeholder="Код" required />
{{--                                        @error('phone') <span class="erro r">{{ $message }}</span> @enderror--}}
                </div>
            </div>
            <input class="button" type="submit" value="Сброс пароля">
        </form>
        <div class="text-center mb-[16px]">
            <span class="text-sc-gray-text"> Повторить отправку через: </span>
        </div>
    </div>
</div>
