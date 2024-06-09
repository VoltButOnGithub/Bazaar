@extends('layouts.settings')

@section('title', __('global.business_settings'))

@section('settings_content')
    <h1 class="m-4 text-4xl font-bold">{{ __('global.business_settings') }} </h1>
    <form method="POST" enctype=multipart/form-data action="{{ route('business.update', $user->id) }}"
          class="flex flex-col gap-6 xl:flex-row">
        @csrf

        <div class="flex flex-col">
            <x-forms.text-input for="name" :label="__('global.name')" :description="__('global.name_description')" value='{{ $user->name }}' />
            <x-forms.fancy-image-input id="profile" for="profilePicture" :label="__('global.profile_picture')" :value='$user->image'
                                       :description="__('global.profile_picture_description')" />
            <x-forms.fancy-image-input id="banner" for="banner_image" :label="__('global.banner_image')" :value='$business->banner_image'
                                       :description="__('global.banner_image_description')" />
            <x-forms.color-input for="primary_color" :label="__('global.primary_color')" :description="__('global.primary_color_description')"
                                 value='{{ $business->primary_color }}' />
            <x-forms.color-input for="secondary_color" :label="__('global.secondary_color')" :description="__('global.secondary_color_description')"
                                 value='{{ $business->secondary_color }}' />
            <x-forms.submit-button :text="__('global.update_business')" />
        </div>
        <div class="flex flex-col">
            <span class="text-wrap block w-72 font-bold text-gray-700">{{ __('global.layout_settings') }}</span>
            <span class="text-wrap block w-96 text-gray-700">{{ __('global.layout_settings_description') }}</span>
            <span
                  class="text-wrap block w-96 font-light text-blue-700">{{ __('global.layout_small_screen_warning') }}</span>
            <div class="flex flex-col md:flex-row">
                <div id="layoutColumn0" class="m-2 w-full flex-col border-2 md:w-1/2">
                    <span class="text-wrap block w-72 font-bold text-gray-700">{{ __('global.column') }} 1</span>
                    <x-businesses.layout-options col='1' :ads="$ads" :layout="$business->layout[1]" />
                </div>
                <div id="layoutColumn1" class="m-2 w-full flex-col border-2 md:w-1/2">
                    <span class="text-wrap block w-72 font-bold text-gray-700">{{ __('global.column') }} 2</span>
                    <x-businesses.layout-options col='2' :ads="$ads" :layout="$business->layout[2]" />
                </div>
            </div>
            <x-forms.submit-button :text="__('global.update_business')" />
        </div>
    </form>
@endsection
