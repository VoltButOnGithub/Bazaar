@extends('layouts.authentication')

@section('title', __('global.register'))

@section('content')
    <div class="px-10 py-5 border">
        <h1 class="text-2xl font-bold text-center mb-6">{{__('global.register')}}</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            @if(session('status'))
                <div class="bg-red-500 text-white p-2 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif
            <div class="mb-4">
                <label for="type" class="block text-gray-700 text-sm font-bold mb-2 mr-2">{{__('global.register_me_as')}}</label>
                    @foreach(\App\Enum\UserTypesEnum::cases() as $type)
                        <x-fancy-radio-button
                            id="userType{{ $type }}"
                            name="type"
                            description="{{ $type->getDescription() }}"
                            value="{{ $type }}"
                            icon="{{ $type->getIcon() }}"
                            label="{{ $type->getLabel() }}"
                            onchange="{{ $type==\App\Enum\UserTypesEnum::BUSINESS ? 'showUrlInput(this);' : '' }}"
                        />
                    @endforeach
            </div>

            <div class="mb-4 max-w-72">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">{{__('global.name')}}</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 max-w-72">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">{{__('global.username')}}</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('username') border-red-500 @enderror">
                @error('username')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 max-w-72">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{__('global.email_address')}}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 max-w-72">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">{{__('global.password')}}</label>
                <input id="password" type="password" name="password" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div id="urlInput" class="mb-4 hidden">
                <label for="url" class="block text-gray-700 text-sm font-bold mb-2">{{__('global.url')}}</label>
                <input id="url" type="text" name="url" required class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('url') border-red-500 @enderror">
                @error('url')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center justify-between mb-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded focus:outline-none focus:shadow-outline">
                    {{__('global.register')}}
                </button>
            </div>
        </form>
        <span>{{__('global.already_have_account')}}</span>
        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700">{{__('global.login_here')}}</a>
    </div>
    <script>
        function showUrlInput(src) {
            if(src.checked) {
                document.getElementById('urlInput').classList.remove('hidden');
            }
            else {
                document.getElementById('urlInput').classList.add('hidden');
            }
        };

        let url = document.getElementById('url');
        const allowedPattern = /[^a-zA-Z0-9-]/g;
        url.addEventListener('input', function (event) {
            const urlInput = event.target;
            urlInput.value = urlInput.value.replace(allowedPattern, '-');
        });

        document.getElementById('name').addEventListener('input', function (event) {
            const nameInput = event.target;
            url.value = nameInput.value;
            url.value = url.value.replace(allowedPattern, '-');
        });
    </script>
@endsection

