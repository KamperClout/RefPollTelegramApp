<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        @auth
            <div class="">
                <!-- Кнопка для открытия навигации -->
                <div class="w-[40px] h-[40px] bg-white border-sc-form border-[1px] rounded-[12px] mt-[46px] ml-[16px]">
                    <button id="showNavButton" class="">
                        <div class="w-[12px] h-[12px]">
                            <span class="fixed top-[60px] left-[30px] block w-[12px] h-[2px] bg-sc-almost-black rounded-[2px]"> </span>
                            <span class="fixed top-[65px] left-[30px] block w-[12px] h-[2px] bg-sc-almost-black rounded-[2px]"> </span>
                            <span class="fixed top-[70px] left-[30px] block w-[12px] h-[2px] bg-sc-almost-black rounded-[2px]"> </span>
                        </div>
                    </button>

                </div>

                <!-- Боковая навигация -->
                <div id="sidebar" class="bg-white h-screen w-64 fixed left-0 top-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 sidebar-closed md:sidebar-open">
                    <div class="w-[40px] h-[40px] bg-white border-sc-form border-[1px] rounded-[12px] mt-[46px] ml-[16px]">
                        <button id="hideNavButton" class="">
                            <div class="">
                                <span class="fixed top-[71.26px] left-[42.68px] block w-[2px] h-[16px] bg-sc-almost-black rounded-[16px] rotate-[-135deg]"></span>
                                <span class="fixed top-[72.68px] left-[31.36px] block w-[2px] h-[16px] bg-sc-almost-black rounded-[16px] rotate-[135deg]"></span>
                            </div>
                        </button>
                    </div>
                    <nav>
                        <ul>
                            <li><a href="/" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded">Мои клиенты</a></li>
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded">Мои выплаты</a></li>
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded"Профиль</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-200 rounded">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        @endauth
        <div class="flex-grow">
            {{ $slot }}
        </div>

        @vite('resources/js/app.js')
        @livewireScripts
    </body>
</html>
