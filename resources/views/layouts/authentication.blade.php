<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bazaar')</title>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen justify-between m-0 p-0 bg-azg-gray">
    <main class="flex-grow flex items-center justify-center">
        @yield('content')
    </main>
    @vite('resources/js/app.js')
</body>
</html>