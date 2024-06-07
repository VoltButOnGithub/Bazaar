@extends('layouts.app')

@section('title', __('global.create_ad'))

@section('content')
    <div class="flex w-full flex-col rounded-lg bg-white p-6 shadow-md">
        <div class="flex items-center justify-between">
            <x-users.card-medium :user="$ad->user" />
        </div>
        <div class="flex flex-col md:flex-row">
            <div class="m-2 flex w-full flex-col md:w-9/12">
                <h2 class="mb-2 border-gray-500 text-2xl font-semibold">{{ __('global.ads') }}</h2>
                @if ($user->ads()->exists())
                    <h2 class="m-2 border-gray-500 text-2xl font-semibold">{{ __('global.related_ads') }}</h2>
                    <div class='flex overflow-x-scroll border'>
                        @foreach ($ads as $ad)
                            <x-ads.card-small :ad='$ad' />
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="flex flex-col md:w-1/3">
                <x-reviews.list :reviews="$reviews" :rating='$ad->rating' :amount='$ad->reviewAmount' :hasForm='auth()->check() && auth()->user()->id != $ad->user_id'
                                :id='$ad->id' type='ad' />
            </div>
        </div>

    </div>
@endsection
