@extends('layouts.app')

@section('title', __('global.create_ad'))

@section('content')
    <x-ads.list :ads='$ads' route='ads' :ad_type='$ad_type' />
@endsection
