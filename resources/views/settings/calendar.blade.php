@extends('layouts.settings')

@section('title', __('global.calendar'))

@section('settings_content')
    <h1 class="m-4 text-4xl font-bold">{{ __('global.calendar') }} </h1>
    <div class="flex flex-col xl:flex-row">
        <div class="m-5 flex-col text-center">
            <span class="text-2xl font-semibold"> {{ __('global.renting') }} </span>
            <x-leases.renting_list :leases="$renting" />
        </div>
        <div class="m-5 flex-col text-center">
            <span class="text-2xl font-semibold"> {{ __('global.renting_out') }} </span>
            <x-leases.renting_out_list :leases="$renting_out" />
        </div>
    </div>

@endsection
