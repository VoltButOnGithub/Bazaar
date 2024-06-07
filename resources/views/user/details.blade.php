@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="flex w-full flex-col rounded-lg bg-white p-6 shadow-md">
        <div class="flex items-center justify-between">
            <div class="flex flex-col rounded-lg border bg-white p-6 shadow-xl">
                <div class='flex justify-between'>
                    <img
                         src='{{ $user->image ? Storage::url($user->image) : __('global.no_image_placeholder') }}'
                         class="m-2 h-24 w-24 rounded" />
                    <div class="flex flex-col justify-center">
                        <span class="text-l font-bold">{{ $user->name }}</span>
                        <span class=" text-xs mb-2 text-gray-500 font-bold">{{ $user->username }}</span>
                        <span class="text-l mb-2">{{ __('global.amount_sold', ['amount' => $user->soldAmount])}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col md:flex-row">
            <div class="m-2 flex w-full flex-col md:w-9/12">
                <span class="mb-2 text-2xl font-semibold">{{ __('global.ads') }}</span>
                @if ($user->ads->count() < 1)
                    <p>{{ __('global.user_has_no_ads') }}</p>
                @else
                    <x-ads.list :ads='$ads' route='user.show' :routeParameter='$user->id' :ad_type='$ad_type' gridClasses="grid-cols-1 lg:grid-cols-2 xl:grid-cols-3"/>
                @endif
            </div>
            <div class="flex flex-col md:w-1/3">
                <x-reviews.list :reviews="$reviews" :rating='$user->rating' :amount='$user->reviewAmount' :hasForm='auth()->check() && auth()->user()->id != $user->id'
                                :id='$user->id' type='user'/>
            </div>
        </div>

    </div>
@endsection
