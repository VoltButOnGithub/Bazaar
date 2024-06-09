@extends('layouts.settings')

@section('title', __('global.api_keys'))

@section('settings_content')

    @if ($new_key)
        <div class="block">
                <div class="flex justify-end">
                    <span class="border p-2">{{__('global.new_key')}}</span>
                    <span class="border p-2">{{ $new_key }}</span>
                </div>
        </div>
    @endif
    @if ($api_keys)
        <div class="block">
            @foreach ($api_keys as $api_key)
                <div class="flex justify-end">
                    <span class="border p-2">{{ $api_key->name }}</span>
                    <x-nav.menu-button :href="route('business.destroy_key', $api_key)" icon="heroicon-s-trash"
                                       classes="h-5 w-5" :text="__('global.destroy_key')" color="red" />
                </div>
            @endforeach
        </div>
    @else
        <span class="mt-4 text-xl">{{ __('global.no_api_keys') }}</span>
    @endif
    <form method="POST" action="{{ route('business.generate_key') }}">
        @csrf
        <x-forms.text-input id="keyName" for="name" :label="__('global.key_name')" />
        <x-forms.submit-button id="submitButton" :text="__('global.generate_key')" />
    </form>
@endsection
