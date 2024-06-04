<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bazaar')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white">
    @include('components.header')

    <div class="container mx-auto mt-8">
        @yield('content')
    </div>
    @include('components.footer')
@vite('resources/js/app.js')
</body>
</html>