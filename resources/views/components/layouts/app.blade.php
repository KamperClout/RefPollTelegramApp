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
            <div class="relative flex w-full">
                <!-- Кнопка для открытия навигации -->
                <button id="showNavButton" class="md:hidden fixed left-4 top-4 px-4 py-2 bg-blue-500 text-white rounded z-10">Открыть</button>

                <!-- Боковая навигация -->
                <div id="sidebar" class="bg-white h-screen p-4 w-64 fixed left-0 top-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 sidebar-closed md:sidebar-open">
                    <button id="hideNavButton" class="md:hidden fixed left-4 top-4 px-4 py-2 bg-blue-500 text-white rounded z-10">Скрыть</button>
                    <nav>
                        <ul>
                            <li><a href="/" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded">Dashboard</a></li>
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded">Profile</a></li>
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded">Settings</a></li>
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
