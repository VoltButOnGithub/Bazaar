@extends('layouts.settings')

@section('title', __('global.api_keys'))

@section('settings_content')
    @if ($api_keys)
        <div class="block">
            @foreach ($api_keys as $api_key)
                <div class="flex justify-end">
                    <span class="border p-2">{{ $api_key }}</span>
                    <x-nav.menu-button :href="route('business.destroy_key', $api_key)" icon="heroicon-s-trash"
                       classes="h-5 w-5" :text="__('global.destroy_key')" color="red" />
                </div>
            @endforeach
        </div>
    @else
        <span class="mt-4 text-xl">{{ __('global.no_api_keys') }}</span>
    @endif
    <x-nav.menu-button :href="route('business.generate_key')" icon="heroicon-s-plus"
                       classes="h-10 w-10" :text="__('global.generate_key')" color="blue" />
@endsection
