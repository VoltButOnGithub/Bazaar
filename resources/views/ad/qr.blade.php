@extends('layouts.app')

@section('title', __('global.create_ad'))

@section('content')
    
    <div class="flex flex-col items-center h-full">
    <x-nav.menu-button :href="route('ad.show', $id)" icon="heroicon-s-arrow-left" classes="h-10 w-10" :text="__('global.back')"/>
    <div class="mt-4">
        {!! $qrCode !!}
    </div>
@endsection