@extends('layouts.app')

@section('title', __('global.create_ad'))

@section('content')
    <x-ads.card-small :ad='$ad' />
@endsection
