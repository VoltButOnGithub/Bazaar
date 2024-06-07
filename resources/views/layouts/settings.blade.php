@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center">
    @include('partials.settings-header')
    @yield('settings_content')
</div>
@endsection
