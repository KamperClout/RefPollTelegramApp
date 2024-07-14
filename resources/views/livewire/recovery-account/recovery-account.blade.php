<div class="big-div">
    @if ($step === 1)
        <div class="bg-white rounded-[28px] w-[344px] h-[293px] mt-[253px] mb-[254px] border-[1px] border-sc-border">
            @if (session()->has('message'))
                <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
                    {{ session('message') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif
            <div class="flex flex-col mt-[24px] ml-[24px]">
                <span class="text-black text-base"> Восстановление </span>
                <span class="text-black font-MontserratBold text-lg"> Аккаунта </span>
            </div>
            <form wire:submit.prevent="sendSms" class="bg-white ml-8 mr-8 mt-24 ">
                <div class="rounded-[20px] border-[1px] border-sc-border pb-[8px] border-opacity-80">
                    <div class="flex flex-col mt-[24px] ml-[8px] mr-[8px] size-[15.02]">
                        <span class="form-span"> Номер телефона </span>
                        <input wire:model.defer="phone" type="phone" class="form-input" name="phone" placeholder="+7 (Номер телефона)" required />
                        @error('phone') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <input onclick="startCountdown()" class="button" type="submit" value="Отправить код по смс">
            </form>
        </div>
    @elseif ($step === 2)
        @if (session()->has('message'))
            <div class="bg-green-200 text-green-800 p-2 mb-4 rounded">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="bg-red-200 text-red-800 p-2 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif
        <div class="bg-white rounded-[28px] w-[344px] h-[293px] mt-[253px] mb-[254px] border-[1px] border-sc-border">
            <div class="flex flex-col mt-[24px] ml-[24px]">
                <span class="text-black text-base"> Восстановление </span>
                <span class="text-black font-MontserratBold text-lg"> Аккаунта </span>
            </div>
            <form wire:submit.prevent="verifySms" class="bg-white ml-8 mr-8 mt-24 ">
                <div class="rounded-[20px] border-[1px] border-sc-border pb-[8px] border-opacity-80">
                    <div class="flex flex-col mt-[24px] ml-[8px] mr-[8px] size-[15.02]">
                        <span class="form-span"> Код СМС </span>
                        <input wire:model.defer="smsCode" type="text" class="form-input" name="phone" placeholder="Код" required />
                        @error('phone') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <input class="button" type="submit" value="Сброс пароля">
            </form>
            <div class="text-center mb-[16px]">
                <span class="text-sc-gray-text"> Повторить отправку через: </span>
                <span class="text-sc-gray-text" id="countdown-timer">30</span>
                <span class="text-sc-gray-text">секунд</span>
            </div>
        </div>
    @endif
</div>

<script>
    function startCountdown() {
        let countdown = 30;
        let timer = setInterval(() => {
            countdown--;
            document.getElementById('countdown-timer').textContent = countdown;
            if (countdown <= 0) {
                clearInterval(timer);
                location.reload();
            }
        }, 1000);
    }
</script>
