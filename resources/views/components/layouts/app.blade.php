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
{{--            <div class="w-[328px] h-[40px] flex flex-row mt-[46px] ml-[16px]">--}}
{{--                <div class="w-[40px] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border p-[14px]">--}}
{{--                    <div class="w-[12px] h-[12px] bg-[url('/images/navigation.png')]">--}}
{{--                        <button class=""></button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="w-[216px] h-[40px] rounded-[12px] bg-white border-[1px] border-sc-border">--}}
{{--                    --}}
{{--                </div>--}}
{{--                <div>--}}

{{--                </div>--}}
{{--            </div>--}}
        @endauth
        <div class="flex-grow">
            {{ $slot }}
        </div>
        @vite('resources/js/app.js')
        @livewireScripts
    </body>
</html>
