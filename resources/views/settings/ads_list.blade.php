@extends('layouts.settings')

@section('title', __('global.settings'))

@section('settings_content')
    <h1 class="text-4xl m-4 font-bold">{{ __('global.' . $query) }} </h1>
    <x-ads.list :ads='$ads' route='settings.{{$query}}' :ad_type='$ad_type' />
@endsection
