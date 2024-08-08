<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-slate-300 h-full w-full p-[8px] justify-items-center">
        <div class="bg-slate-300 w-full h-full justify-items-center">
                @auth
                    <div class="flex flex-col justify-items-center" style="position: absolute; z-index: 8; top: 46px;">
                        <div class=" flex flex-row">
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
                            <div class="text-center w-[216px] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border ml-[16px]  pt-[7px]" onclick="changePageTitle('Мои выплаты')">
                                <span class="" id="pageTitle">  </span>
                            </div>
                            <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px] ml-[16px]">
                                @csrf
                                <div onclick="document.getElementById('logoutForm').submit()" class="w-[16px] h-[16px] bg-[url('/images/notification.png')] cursor-pointer">
                                    <button class=""></button>
                                </div>
                            </form>
                        </div>
                        <div id="sidebar" class="absolute w-full h-[192px] bg-white rounded-[28px] border-[1px] border-sc-border" style="display: none; top: 62px;">
                            <a href="/my-clients" class="flex flex-row w-full h-[56px] rounded-[12px] bg-white border-[1px] border-sc-border ml-[8px] mt-[8px] pl-[8px] pt-[8px]">
                                <div class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px]">
                                    <div class="w-[16px] h-[16px] bg-[url('/images/profile-2user.png')]">
                                        <button class=""></button>
                                    </div>
                                </div>
                                <span class="ml-[16px] mt-[7px] font-[13px] font-Montserrat font-medium text-sc-almost-black"> Мои Клиенты </span>
                            </a>
                            <a href="/" class="flex flex-row w-full h-[56px] rounded-[12px] bg-white border-[1px] border-sc-border ml-[8px] mt-[4px] pl-[8px] pt-[8px]">
                                <div class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px]">
                                    <div class="w-[16px] h-[16px] bg-[url('/images/dollar-square.png')]">
                                        <button class=""></button>
                                    </div>
                                </div>
                                <span class="ml-[16px] mt-[7px] font-[13px] font-Montserrat font-medium text-sc-almost-black"> Мои Выплаты </span>
                            </a>
                            <a href="/my-profile" class="flex flex-row w-full h-[56px] rounded-[12px] bg-white border-[1px] border-sc-border ml-[8px] mt-[4px] pl-[8px] pt-[8px]">
                                <div class="w-[40x] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[12px]">
                                    <div class="w-[16px] h-[16px] bg-[url('/images/personalcard.png')]">
                                        <button class=""></button>
                                    </div>
                                </div>
                                <span class="ml-[16px] mt-[7px] font-[13px] font-Montserrat font-medium text-sc-almost-black"> Профиль </span>
                            </a>
                        </div>
                    </div>
                @endauth
                    <div class="bg-sc-main-font fixed top-0 left-0 w-full h-full" id="shadowDiv" style="z-index: 2; background-color: rgba(0, 0, 0, 0.16); display: none;">
                        <!-- тень -->
                    </div>
                <div class="flex content-center justify-center items-center h-[80vh]"  id="darkening">
                    {{ $slot }}
                </div>
            </div>

        <script>
            function toggleSidebar() {
                var sidebar = document.getElementById('sidebar');
                var buttonShow = document.getElementById('buttonShow');
                var buttonHide = document.getElementById('buttonHide');
                var shadowDiv = document.getElementById('shadowDiv');
                if (sidebar.style.display === 'none') {
                    sidebar.style.display = 'block';
                    buttonShow.style.display = 'none';
                    buttonHide.style.display = 'block';
                    shadowDiv.style.display = 'block';
                } else {
                    sidebar.style.display = 'none';
                    buttonShow.style.display = 'block';
                    buttonHide.style.display = 'none';
                    shadowDiv.style.display = 'none';
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
