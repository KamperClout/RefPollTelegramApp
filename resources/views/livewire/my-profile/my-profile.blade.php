<div class="big-div">
    <div>
        <div class="fixed top-[46px] left-[8px] w-[328px] h-[40px] flex flex-row">
            <div id="buttonShow" class="w-[40px] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[14px] ml-[8px] cursor-pointer" onclick="toggleSidebar()">
                <div class="w-[12px] h-[12px] bg-[url('/images/navigation.png')]">
                    <button class=""></button>
                </div>
            </div>
            <div id="buttonHide" class="w-[40px] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[7.5px] ml-[8px] cursor-pointer" style="display: none;" onclick="toggleSidebar()">
                <div class="w-[23px] h-[23px] bg-[url('/images/exit.png')]">
                    <button class=""></button>
                </div>
            </div>
            <div class="w-[216px] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border ml-[16px] pl-[57px] pt-[7px]" onclick="changePageTitle('Мой профиль')">
                <span class="" id="pageTitle"> Мой профиль </span>
            </div>
            <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px] ml-[16px]">
                @csrf
                <div onclick="document.getElementById('logoutForm').submit()" class="w-[16px] h-[16px] bg-[url('/images/notification.png')] cursor-pointer">
                    <button class=""></button>
                </div>
            </form>
        </div>
        <div class="w-[344px] h-[164px] bg-white rounded-[28px] border-[1px] border-sc-border flex flex-col mt-[26px]">
            <div class="flex flex-col ml-[24px] mt-[32px]">
                <span class="text-base text-[16px] font-medium font-MontserratBold text-sc-almost-black"> Мой </span>
                <span class=" font-semibold font-MontserratBold text-[24px] text-sc-almost-black"> Профиль </span>
            </div>
            <div class="text-sc-check ml-[24px] text-[24px]">
                {{$surname . ' ' . $name . ' ' . $patronymic}}
            </div>
            @if ($test_passed)
                <div class="h-[15px] text-sc-check font-MontserratBold text-[12px] ml-[24px] flex flex-row">
                    Тест сдан
                    <div class="w-[16px] h-[16px] ml-[4px] bg-[url('/images/discount-shape.png')]"></div>
                </div>
            @else
                <div class="w-[80px] h-[15px] text-sc-almost-black font-MontserratBold text-[12px] ml-[24px]">
                    Тест не сдан
                </div>
            @endif
        </div>
        <div class="mt-[8px] w-[344px] h-[252px] bg-white rounded-[28px] border-[1px] border-sc-border flex flex-col">
            <a href="#" class="flex flex-row w-[328px] h-[56px] rounded-[20px] bg-white border-[1px] border-sc-border ml-[8px] mt-[8px] pl-[8px] pt-[8px]">
                <div class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px]">
                    <div class="w-[16px] h-[16px] bg-[url('/images/book.png')]">
                        <button class=""></button>
                    </div>
                </div>
                <span class="ml-[16px] mt-[13px] font-[13px] font-Montserrat font-medium text-sc-almost-black"> Пройти обучение </span>
            </a>
            <a href="#" class="flex flex-row w-[328px] h-[56px] rounded-[20px] bg-white border-[1px] border-sc-border ml-[8px] mt-[4px] pl-[8px] pt-[8px]">
                <div class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px]">
                    <div class="w-[16px] h-[16px] bg-[url('/images/clipboard-tick.png')]">
                        <button class=""></button>
                    </div>
                </div>
                <span class="ml-[16px] mt-[13px] font-[13px] font-Montserrat font-medium text-sc-almost-black"> Пройти тест </span>
            </a>
            <a href="#" class="flex flex-row w-[328px] h-[56px] rounded-[20px] bg-white border-[1px] border-sc-border ml-[8px] mt-[4px] pl-[8px] pt-[8px]">
                <div class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px]">
                    <div class="w-[16px] h-[16px] bg-[url('/images/document-text.png')]">
                        <button class=""></button>
                    </div>
                </div>
                <span class="ml-[16px] mt-[13px] font-[13px] font-Montserrat font-medium text-sc-almost-black"> Реквизиты самозанятого </span>
            </a>
            <a href="#" class="flex flex-row w-[328px] h-[56px] rounded-[20px] bg-white border-[1px] border-sc-border ml-[8px] mt-[4px] pl-[8px] pt-[8px]">
                <div class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px]">
                    <div class="w-[16px] h-[16px] bg-[url('/images/headphone.png')]">
                        <button class=""></button>
                    </div>
                </div>
                <span class="ml-[16px] mt-[13px] font-[13px] font-Montserrat font-medium text-sc-almost-black"> Связаться с поддержкой </span>
            </a>
        </div>
    </div>
</div>
