@extends('layouts.authentication')

@section('title', __('global.login'))

@section('content')
    <div class="px-10 py-5 border">
        <h1 class="text-2xl font-bold text-center mb-6">{{__('global.login')}}</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            @if(session('status'))
                <div class="bg-red-500 text-white p-2 rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{__('global.email_address')}}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">{{__('global.password')}}</label>
                <input id="password" type="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox text-indigo-600">
                    <span class="ml-2 text-gray-700">{{__('global.remember_me')}}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mb-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded focus:outline-none focus:shadow-outline">
                    {{__('global.login')}}
                </button>
            </div>
        </form>
        <span>{{__('global.no_account_yet')}}</span>
        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700">{{__('global.start_here')}}</a>
    </div>
@endsection