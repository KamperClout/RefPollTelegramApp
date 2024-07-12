<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- другие мета-теги и заголовки -->

    <!-- Подключение CSS файла с Vite -->
    @vite('resources/css/app.css')
</head>
<body>
<!-- Содержимое страницы -->
@yield('content')

<!-- Подключение JS файла с Vite -->
@vite('resources/js/app.js')
</body>
</html>
