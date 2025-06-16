<div class="h-[80vh] bg-white rounded-[28px] w-full ">
    <div class="h-[80vh] flex flex-col border-[1px] border-sc-border rounded-[28px] pb-[8px]">
        <div class="flex justify-between items-center mt-[24px] ml-[24px] mr-[24px]">
            <div class="flex flex-col">
                <span class="text-[16px] font-medium text-sc-almost-black"> Регистрация</span>
                <span class="text-[24px] font-semibold text-sc-almost-black"> Аккаунта</span>
            </div>
            <div class="w-[23px] h-[23px] bg-[url('/images/exit.png')] place-self-end mt-[24px] mr-24 cursor-pointer">
                    <button class=""></button>
            </div>
        </div>
        <form class="bg-white ml-8 mr-8">
            <div class="rounded-[20px] border-[1px] border-sc-border pb-[8px] border-opacity-80">
                <div class="form-div">
                    <span class="form-span"> Ваше ФИО </span>
                    <input type="text" class="form-input" name="fio" placeholder="Фамилия Имя Отчество*" required/>
                    @error('fio') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-div">
                    <span class="form-span"> Номер телефона </span>
                    <input type="text" class="form-input" name="phone" placeholder="+7 (Номер телефона)" required />
                    @error('phone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-div">
                    <span class="form-span"> Ваш регион </span>
                    <input type="text" class="form-input" name="region" placeholder="Россия, (Регион)" />
                    @error('region') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <input class="bg-sc-yellow w-full font-semibold mt-[20px] rounded-[20px] h-[64px] cursor-pointer" type="submit" value="Зарегистрироваться">
        </form>
    </div>
</div>



