<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bazaar')</title>
    @vite('resources/css/app.css')
</head>

<body class="flex min-h-screen flex-col overflow-y-scroll bg-white">
    @if (session('success'))
        <div id="successAlert" onclick="hideSuccess()" class="cursor-pointer fixed top-32 flex w-full flex-col items-center">
            <span
                  class="flex w-96 flex-col items-center rounded-lg border-4 border-green-400 bg-green-100 py-4 text-center">
                <x-heroicon-s-check-circle class="h-10 w-10 text-green-700" />
                <span class="mb-2 text-3xl">
                    {{ session('success') }}
                </span>
                <span class="mb-2 text-2xl">
                    {{ __('global.click_to_dismiss') }}
                </span>
            </span>
        </div>
        <script>
            function hideSuccess() {
                document.getElementById("successAlert").classList.add("hidden");
            }
        </script>
    @endif
    <header class="sticky top-0 z-50 bg-white shadow-md">
        @include('partials.header')
    </header>

    <main class="flex flex-grow justify-center xl:ml-32 xl:mr-32">
        @yield('content')
    </main>
    <footer class="mt-auto">
        @include('partials.footer')
    </footer>
    @vite('resources/js/app.js')
</body>

</html>
