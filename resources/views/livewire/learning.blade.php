<div class="pb-[56px]">
    <div class="bg-custom rounded-3xl p-3 ">
        <div class="flex justify-between items-center mb-4">
            <div style="line-height: 0.8;">
                <p class="text-sc-almost-black font-medium text-[15px]">маркетинговые</p>
                <p class="text-[24px] font-semibold text-sc-almost-black">материалы</p>
            </div>
            <div wire:navigate
                 href="{{ route('main-page') }}" class="flex items-center justify-center gap-3 cursor-pointer relative">
                <div class="w-10 h-10 bg-white rounded-[12px] flex items-center justify-center">
                    <img src="icons/home-2.png" alt="Главная" class="w-6 h-6"/>
                </div>
                {{--            <div class="w-10 h-10 bg-white rounded-[12px] flex items-center justify-center">--}}
                {{--                <img src="icons/notification.png" alt="Настройки" class="w-6 h-6"/>--}}
                {{--            </div>--}}
            </div>
        </div>
        <div class="relative mb-4">
            <div class="absolute -inset-1 rounded-lg bg-gradient-to-r from-yellow-600 via-sc-check to-yellow-300 opacity-35 blur-md"></div>
            <div class="relative p-4 rounded-2xl bg-sc-white-72">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <img src="icons/book.png" alt="Обучение" class="w-6 h-6"/>
                    </div>
                    <h3 class="text-lg font-semibold text-sc-almost-black">Как работать с анкетами</h3>
                </div>
                <div class="prose prose-sm max-w-none text-sc-almost-black space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-green-600">Как заполнять:</p>
                            <p>Внимательно читайте каждый вопрос. Если не уверены в ответе, можно пропустить и вернуться позже.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-red-600">Не делайте так:</p>
                            <p>Не оставляйте все ответы на потом. Заполняйте анкету последовательно, это поможет не пропустить важные вопросы.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-green-600">Как делиться:</p>
                            <p>Нажмите кнопку "Поделиться" под анкетой. Вы получите ссылку, которую можно отправить в мессенджере или соцсетях.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-red-600">Не делайте так:</p>
                            <p>Не отправляйте анкету незнакомым людям в личные сообщения. Используйте общие чаты или публичные посты.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
