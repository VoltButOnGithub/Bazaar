@extends('layouts.authentication')

@section('title', __('global.login'))

@section('content')
    <div class="border px-10 py-5">
        <h1 class="mb-6 text-center text-2xl font-bold">{{ __('global.login') }}</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            @error('login')
                <p class="max-w-60 text-pretty mb-4 mt-2 text-xs italic text-red-500">{{ $message }}</p>
            @enderror

            @if (session('status'))
                <div class="mb-4 rounded bg-red-500 p-2 text-white">
                    {{ session('status') }}
                </div>
            @endif

            <x-forms.text-input for="username" :label="__('global.username')" />
            <x-forms.text-input for="password" type="password" :label="__('global.password')" />

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox text-indigo-600">
                    <span class="ml-2 text-gray-700">{{ __('global.remember_me') }}</span>
                </label>
            </div>

            <x-forms.submit-button :text="__('global.login')" />
        </form>
        <span>{{ __('global.no_account_yet') }}</span>
        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700">{{ __('global.start_here') }}</a>
    </div>
@endsection
