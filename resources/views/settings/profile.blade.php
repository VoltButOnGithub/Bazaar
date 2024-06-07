@extends('layouts.settings')

@section('title', __('global.profile_settings'))

@section('settings_content')
    <h1 class="m-4 text-4xl font-bold">{{ __('global.profile_settings') }} </h1>
    <form method="POST" enctype=multipart/form-data action="{{ route('profile.update', $user->id) }}">
        @csrf
        <x-forms.text-input for="name" :label="__('global.name')" :description="__('global.name_description')" value='{{$user->name}}'/>
        <x-forms.fancy-image-input for="profilePicture" :label="__('global.profile_picture')" :value='$user->image' :description="__('global.profile_picture_description')" />
        <x-forms.submit-button :text="__('global.update_profile')" />
    </form>
@endsection
