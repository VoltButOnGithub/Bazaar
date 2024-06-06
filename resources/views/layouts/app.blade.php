<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bazaar')</title>
    @vite('resources/css/app.css')
</head>

<body class="overflow-y-scroll bg-white">
    <header class="sticky top-0 z-50 bg-white shadow-md">
        @include('partials.header')
    </header>
    <main class="flex flex-grow items-center justify-center">
        @yield('content')
    </main>
    <footer>
        @include('partials.footer')
    </footer>
    @vite('resources/js/app.js')
</body>

</html>
