<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bazaar')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-azg-gray m-0 flex min-h-screen flex-col justify-between overflow-y-scroll p-0">

<header class="sticky top-0 z-50 bg-white shadow-md">
    <nav class="bg-gray-400 p-4">
        <div class="container mx-auto flex items-center justify-between">
            <div class="text-lg font-bold text-black">
                <a href="{{ url('/') }}">{{ __('global.bazaar') }}</a>
            </div>

                <form id="languageForm" action="{{ route('changeLang') }}" method="post">
                    @csrf
                    <select name="lang"
                            class="flex cursor-pointer items-center rounded-md bg-gray-600 px-3 py-3 text-sm font-medium text-white hover:bg-gray-700"
                            onchange="submitForm()">

                        @foreach (config('app.locales') as $locale)
                            <option value={{ $locale }}
                                    @if ($locale == App::currentLocale()) selected @endif> {{ __('global.' . $locale) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </nav>
</header>

    <main class="flex flex-grow items-center justify-center">
        @yield('content')
    </main>
    <script>
        function submitForm() {
            document.getElementById("languageForm").submit();
        }
</script>
    @vite('resources/js/app.js')
</body>

</html>
