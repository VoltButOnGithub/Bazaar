@extends('layouts.app')

@section('title', __('global.create_ad'))

@php 
    $adTypeKeys = \App\Enum\AdTypesEnum::getKeys();
    $fieldIds = ["name", "description", "price"];

    $adInputLabels = [];
    $adInputDescriptions = [];
    foreach($adTypeKeys as $key) {
        foreach($fieldIds as $id) {
            $adInputLabels[$key.$id] = __($key.'.'.$id);
            $adInputDescriptions[$key.$id] = __($key.'.'.$id.'_description');
        }
    }
@endphp

@section('content')
    <div class="rounded border px-10 py-5">
        <h1 class="mb-6 text-center text-2xl font-bold">{{ __('global.create_ad') }}</h1>
        <form method="POST" action="{{ route('advertisement.create') }}">
            @csrf
            @if (session('status'))
                <div class="mb-4 rounded bg-red-500 p-2 text-white">
                    {{ session('status') }}
                </div>
            @endif

            <x-forms.fancy-radio id="adType" name="type" :label="__('global.i_want_to_post_a')" :options="\App\Enum\AdTypesEnum::cases()" />

            <x-forms.text-input id="name" for="name" :label="__('global.name')" :description="__('global.name_description')" classes="hidden" />
            <x-forms.textarea-input id="description" for="description" :label="__('global.description')" :description="__('global.description_description')" classes="hidden"/>
            <x-forms.price-input id="price" for="price" :label="__('global.price')" :description="__('global.description_description')" classes="hidden" />

            <x-forms.submit-button :text="__('global.create_ad')" />

        </form>
    </div>

    <script>
        const adTypeKeys = @json($adTypeKeys);
        const fieldIds = ["name", "description", "price"];
        const adInputLabels = @json($adInputLabels);
        const adInputDescriptions = @json($adInputDescriptions);

        let radios = document.querySelectorAll('input[name="type"]');
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                showForm();
                radios.forEach(radio => {
                    if(radio.checked) {
                        changeLabelsAndDescriptionsTo(radio.value);
                    }
                });
            });
        });

        function changeLabelsAndDescriptionsTo(adType) {
            fieldIds.forEach(fieldId => {
                document.getElementById(fieldId+"Label").innerHTML = adInputLabels[adTypeKeys[adType]+fieldId];
                document.getElementById(fieldId+"Description").innerHTML = adInputDescriptions[adTypeKeys[adType]+fieldId];
            });
        }

        function showForm() {
            fieldIds.forEach( fieldId => {
                document.getElementById(fieldId).classList.remove('hidden');
            });
        }
    </script>
@endsection
