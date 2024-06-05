<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bazaar')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white">
    @include('partials.header')
    <main class="flex flex-grow items-center justify-center">
        @yield('content')
    </main>
    @include('partials.footer')
    @vite('resources/js/app.js')
</body>

</html>
