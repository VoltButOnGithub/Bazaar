@extends('layouts.app')

@section('title', __('global.create_ad'))

@section('content')
    <div class="flex flex-col rounded-lg bg-white p-6 shadow-md">
        <div class="flex items-center justify-between">
            <h1 class="m-2 text-3xl font-bold md:text-5xl"> {{ $ad->name }}</h1>
            <x-dynamic-component :component="$ad->type->getIcon()" class="mr-2 h-9 w-9 md:h-12 md:w-12" />
        </div>

        <div class="flex overflow-x-scroll">
            @if ($ad->images)
                @foreach ($ad->images as $image)
                    <img src="{{ $ad->images ? Storage::url($image) : __('global.no_image_placeholder') }}"
                         class="m-2 h-96 rounded object-contain" />
                @endforeach
            @else
                <img src="{{ __('global.no_images_placeholder') }}"
                     class="mb-4 h-72 rounded object-contain" />
            @endif
        </div>

        <div>
            <div class='border-3 flex items-center justify-between border'>
                <h2 class="m-2 text-4xl font-semibold">€ {{ $ad->price }}</h2>

                <a href="route('ad.buy')"
                   class="focus:shadow-outline rounded bg-blue-600 px-6 py-4 text-3xl font-bold text-white hover:bg-blue-700 focus:outline-none">
                    {{ $ad->type->getBuyAction() }}
                </a>
                <x-ads.favourite-button :adId="$ad->id"/>
            </div>
        </div>
        <div class="grid grid-rows-1 md:grid-rows-2">
            <div>
                <h2 class="mb-2 border-gray-500 text-2xl font-semibold">{{ __('global.description') }}</h2>
                <p>{{ $ad->description }}</p>
            </div>
        </div>
        @if ($ad->type->isRental())
            <div class="flex items-center">
                <span class="ml-1">{{ $ad->rating }}</span>
                <span class="text-yellow-500">&#9733;</span>
                <span>({{ $ad->reviewAmount }})</span>
            </div>
        @endif

    </div>
@endsection
