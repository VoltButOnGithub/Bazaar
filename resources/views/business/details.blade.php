@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="flex w-full flex-col rounded-lg bg-white p-6 shadow-md">
        <div class="flex h-72 w-full items-end justify-center rounded-xl bg-slate-700 bg-cover"
             style="
             @if ($business->banner_image) background-image: url({{ Storage::url($user->image) }}); @endif
             @if ($business->secondary_color) background-color: {{ $business->secondary_color }} @endif
             ">
            <div class="flex flex-col rounded-lg border-8 border-gray-500 bg-white p-6 shadow-xl"
                 style="
            @if ($business->primary_color) border-color: {{ $business->primary_color }} @endif
            ">
                <div class='flex'>
                    <img src='{{ $user->image ? Storage::url($user->image) : __('global.no_image_placeholder') }}'
                         class="m-2 h-24 w-24 rounded" />
                    <div class="flex flex-col justify-center">
                        <span class="text-l font-bold">{{ $user->name }}</span>
                        <span class="mb-2 text-xs font-bold text-gray-500">{{ $user->username }}</span>
                        <span class="text-l mb-2">{{ __('global.amount_sold', ['amount' => $user->soldAmount]) }}</span>
                        @auth
                        @if (Auth::user()->id == $user->id)
                            <div class="mx-auto">
                                <x-nav.menu-button :href="route('business.edit')" icon="heroicon-s-cog-6-tooth"
                                                   :text="__('global.business_settings')" />
                            </div>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <div class="flex h-3 w-full items-end justify-center rounded-xl bg-gray-500 bg-cover"
             style="
             @if ($business->primary_color) background-color: {{ $business->primary_color }} @endif
             ">
        </div>
        <div class="flex flex-col md:flex-row">
            @foreach ($business->layout as $cols)
                <div class="m-2 flex w-full flex-col md:w-1/2">
                    @foreach ($cols as $sections)
                        @if ($sections[0] == 'ads')
                            <span class="mb-2 text-2xl font-semibold">{{ __('global.ads') }}</span>
                            @if ($user->ads->count() < 1)
                                <p>{{ __('global.user_has_no_ads') }}</p>
                            @else
                                <x-ads.list :ads='$ads' route='user.show' :routeParameter='$user->id' :ad_type='$ad_type'
                                            gridClasses="grid-cols-1 lg:grid-cols-2" />
                            @endif
                        @endif
                        @if ($sections[0] == 'reviews')
                            <x-reviews.list :reviews="$reviews" :rating='$user->rating' :amount='$user->reviewAmount' :hasForm='auth()->check() && auth()->user()->id != $user->id'
                                            :id='$user->id' type='user' />
                        @endif
                        @if ($sections[0] == 'pinned_ad')
                            <span class="mb-2 text-2xl font-semibold">{{ __('global.pinned_ad') }}</span>
                            <x-ads.card-small :ad="$ads->find($sections['pinned_ad'])" />
                        @endif
                        @if ($sections[0] == 'image')
                            <x-businesses.image url="{{ Storage::url($sections['image']) }}" />
                        @endif
                        @if ($sections[0] == 'text')
                            <span class="mb-2 text-2xl font-semibold">{{ $sections['text'] }}</span>
                        @endif
                    @endforeach

                </div>
            @endforeach
        </div>

        <div class="flex flex-col md:flex-row">

            <div class="flex flex-col md:w-1/3">

            </div>
        </div>

    </div>
@endsection
