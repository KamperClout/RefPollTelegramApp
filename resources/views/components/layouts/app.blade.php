<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        @auth
            <div class="flex flex-col">
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
                    <div class="w-[216px] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border ml-[16px] pl-[57px] pt-[7px]" onclick="changePageTitle('Мои выплаты')">
                        <span class="" id="pageTitle">  </span>
                    </div>
                    <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px] ml-[16px]">
                        @csrf
                        <div onclick="document.getElementById('logoutForm').submit()" class="w-[16px] h-[16px] bg-[url('/images/notification.png')] cursor-pointer">
                            <button class=""></button>
                        </div>
                    </form>
                </div>
                <div id="sidebar" class="fixed top-[102px] left-[8px] w-[344px] h-[192px] bg-white rounded-[28px] border-[1px] border-sc-border" style="display: none;">
                    <a href="/my-clients" class="flex flex-row w-[328px] h-[56px] rounded-[12px] bg-white border-[1px] border-sc-border ml-[8px] mt-[8px] pl-[8px] pt-[8px]">
                        <div class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px]">
                            <div class="w-[16px] h-[16px] bg-[url('/images/profile-2user.png')]">
                                <button class=""></button>
                            </div>
                        </div>
                        <span class="ml-[16px] mt-[7px]"> Мои Клиенты </span>
                    </a>
                    <a href="/" class="flex flex-row w-[328px] h-[56px] rounded-[12px] bg-white border-[1px] border-sc-border ml-[8px] mt-[4px] pl-[8px] pt-[8px]">
                        <div class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px]">
                            <div class="w-[16px] h-[16px] bg-[url('/images/dollar-square.png')]">
                                <button class=""></button>
                            </div>
                        </div>
                        <span class="ml-[16px] mt-[7px]"> Мои Выплаты </span>
                    </a>
                    <a href="/my-profile" class="flex flex-row w-[328px] h-[56px] rounded-[12px] bg-white border-[1px] border-sc-border ml-[8px] mt-[4px] pl-[8px] pt-[8px]">
                        <div class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px]">
                            <div class="w-[16px] h-[16px] bg-[url('/images/personalcard.png')]">
                                <button class=""></button>
                            </div>
                        </div>
                        <span class="ml-[16px] mt-[7px]"> Профиль </span>
                    </a>
                </div>
            </div>
        @endauth
        <div class="flex-grow">
            {{ $slot }}
        </div>
        <script>
            function toggleSidebar() {
                var sidebar = document.getElementById('sidebar');
                var buttonShow = document.getElementById('buttonShow');
                var buttonHide = document.getElementById('buttonHide');
                if (sidebar.style.display === 'none') {
                    sidebar.style.display = 'block';
                    buttonShow.style.display = 'none';
                    buttonHide.style.display = 'block';
                } else {
                    sidebar.style.display = 'none';
                    buttonShow.style.display = 'block';
                    buttonHide.style.display = 'none';
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                setPageTitleFromUrl();
            });

            function setPageTitleFromUrl() {
                var pathName = window.location.pathname;
                var pageTitle = '';

                switch (pathName) {
                    case '/':
                        pageTitle = 'Мои выплаты';
                        break;
                    case '/my-clients':
                        pageTitle = 'Мои клиенты';
                        break;
                    case '/my-profile':
                        pageTitle = 'Профиль';
                        break;
                    default:
                        pageTitle = 'Навигация';
                }

                var pageTitleSpan = document.getElementById('pageTitle');
                pageTitleSpan.textContent = pageTitle;
            }

            function changePageTitle(title) {
                var pageTitleSpan = document.getElementById('pageTitle');
                pageTitleSpan.textContent = title;
            }
        </script>
        @vite('resources/js/app.js')
        @livewireScripts
    </body>
</html>
