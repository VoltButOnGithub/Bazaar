@extends('layouts.app')

@section('title', __('global.create_ad'))

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5">
    @foreach($ads as $ad) 
        <x-ads.card-small :ad='$ad' />
    @endforeach
    </div>
@endsection
