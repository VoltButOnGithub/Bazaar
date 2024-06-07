@extends('layouts.app')

@section('title', __('global.create_ad'))

@section('content')
    <div class="flex flex-col rounded-lg bg-white p-6 shadow-md">
        <div class="flex items-center justify-between">
            <h1 class="m-2 text-3xl font-bold md:text-5xl"> {{ $ad->name }}</h1>
            <x-dynamic-component :component="$ad->type->getIcon()" class="mr-2 h-9 w-9 md:h-12 md:w-12" />
            <x-users.card-medium :user="$ad->user" />
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
                <h2 class="m-2 text-4xl font-semibold">{{ $ad->type->getPriceLabel($ad->price) }}</h2>

                <a href="{{ route('ad.buy', $ad->id) }}"
                   class="focus:shadow-outline rounded bg-blue-600 px-6 py-4 text-3xl font-bold text-white hover:bg-blue-700 focus:outline-none">
                    {{ $ad->type->getBuyAction() }}
                </a>
                <x-ads.favourite-button :adId="$ad->id" />
            </div>
        </div>
        <div class="flex flex-col md:flex-row">
            <div class="flex flex-col m-2 w-full md:w-9/12">
                <h2 class="mb-2 border-gray-500 text-2xl font-semibold">{{ __('global.description') }}</h2>
                <p>{{ $ad->description }}</p>
                @if($ad->relatedAds()->exists())
                <h2 class="m-2 border-gray-500 text-2xl font-semibold">{{ __('global.related_ads') }}</h2>
                <div class='flex border overflow-x-scroll'>
                    @foreach($ad->relatedAds()->get() as $relatedAd)
                        <x-ads.card-small :ad='$relatedAd' />
                    @endforeach
                </div>
                @endif
            </div>
            @if ($ad->type->isRental())
                <div class="flex flex-col md:w-1/3">
                    <x-reviews.list :reviews="$reviews" :rating='$ad->rating' :amount='$ad->reviewAmount' :hasForm='auth()->check() && auth()->user()->id != $ad->user_id' :id='$ad->id' type='ad'/>
                </div>
            @endif
        </div>

    </div>
@endsection
