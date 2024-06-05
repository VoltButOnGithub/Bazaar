@extends('layouts.authentication')

@section('title', __('global.register'))

@section('content')
    <div class="rounded border px-10 py-5">
        <h1 class="mb-6 text-center text-2xl font-bold">{{ __('global.register') }}</h1>
        <form method="POST" enctype=multipart/form-data action="{{ route('register') }}">
            @csrf
            @if (session('status'))
                <div class="mb-4 rounded bg-red-500 p-2 text-white">
                    {{ session('status') }}
                </div>
            @endif

            <x-forms.fancy-radio id="userType" name="type" :label="__('global.register_me_as')" :options="\App\Enum\UserTypesEnum::cases()" />

            <x-forms.text-input for="name" :label="__('global.name')" :description="__('global.name_description')" />
            <x-forms.text-input for="username" :label="__('global.username')" :description="__('global.username_description')" />
            <x-forms.text-input for="password" type="password" :label="__('global.password')" :description="__('global.password_description')" />
            <x-forms.text-input id="urlInput" for="url" :label="__('global.url')" prefix="{{ request()->getHost() }}/"
                                :description="__('global.url_description')"
                                classes="hidden" />
            <x-forms.fancy-image-input for="profilePicture" :label="__('global.profile_picture')" :description="__('global.profile_picture_description')" />
            
            <x-forms.submit-button :text="__('global.register')" />
        </form>
        <span>{{ __('global.already_have_account') }}</span>
        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700">{{ __('global.login_here') }}</a>
    </div>

    <script>
        const businessRadio = document.getElementById('type2');
        const url = document.getElementById('url');
        const nameInput = document.getElementById('name');

        document.querySelectorAll('input[name="type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                if (businessRadio.checked) {
                    document.getElementById('urlInput').classList.remove('hidden');
                } else {
                    url.value = nameInput.value;
                    document.getElementById('urlInput').classList.add('hidden');
                }
            });
        });

        const allowedPattern = /[^a-zA-Z0-9-]/g;

        url.addEventListener('input', function(event) {
            const urlInput = event.target;
            urlInput.value = urlInput.value.replace(allowedPattern, '-');
            url.value = url.value.toLowerCase();
        });

        document.getElementById('name').addEventListener('input', function(event) {
            url.value = nameInput.value;
            url.value = url.value.replace(allowedPattern, '-');
            url.value = url.value.toLowerCase();
        });
    </script>
@endsection
