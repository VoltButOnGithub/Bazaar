@extends('layouts.app')

@section('title', __('global.create_ad'))

@section('content')
    <div class="rounded border px-10 py-5">
        <h1 class="mb-6 text-center text-2xl font-bold">{{ __('global.create_ad') }}</h1>
        <form method="POST" action="{{ route('ad.store') }}" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <p class="mb-2 text-xs italic text-red-500">{{ __('global.error_try_again') }}</p>
            @endif
            <x-forms.fancy-radio id="type" name="ad_type" :label="__('global.i_want_to_post_a')" :options="\App\Enum\AdTypesEnum::cases()" />

            <x-forms.text-input id="name" for="ad_name" :label="__('global.name')" :description="__('global.name_description')" classes="hidden" />
            <x-forms.textarea-input id="description" for="ad_description" :label="__('global.description')" :description="__('global.description_description')"
                                    classes="hidden" />
            <x-forms.price-input id="price" for="ad_price" :label="__('global.price')" :description="__('global.description_description')" classes="hidden" />
            <x-forms.fancy-multi-image-input id="image" for="ad_images[]" :label="__('global.images')" :description="__('global.images_description')"
                                             classes="hidden" />

            <div id="relatedAdsDiv" class='mb-4 hidden'>
                <label id="relatedAdsLabel" for="relatedAds[]"
                       class="text-wrap block w-72 text-sm font-bold text-gray-700">{{ __('global.related_ads') }}</label>
                <p id="relatedAdsDescription" class="text-wrap mb-2 w-72 text-xs">{{ __('global.related_ads_description') }}
                </p>
                <div
                     class="@error('relatedAds[]') border-red-500 @enderror h-20 w-72 overflow-y-scroll text-gray-700 shadow focus:border-blue-400">
                    @foreach ($relatedAds as $ad)
                        <label for="relatedAd-{{ $ad->id }}" class="flex items-center border text-gray-700">
                            <input id="relatedAd-{{ $ad->id }}" type="checkbox" name="relatedAds[]"
                                   value="{{ $ad->id }}"
                                   class="form-checkbox m-1 h-5 w-5">
                            {{ $ad->name }}
                        </label>
                    @endforeach
                    @error('relatedAds')
                        <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <x-forms.submit-button id="submitButton" :text="__('global.create_ad')" classes="hidden" />

        </form>
    </div>

    <script>
        let radios = document.querySelectorAll('input[name="ad_type"]');
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                showForm();
                radios.forEach(radio => {
                    if (radio.checked) {
                        changeLabelsAndDescriptionsTo(radio.value);
                    }
                });
            });
        });

        const adTypeKeys = @json($adTypeKeys);
        const fieldIds = @json($fieldIds);
        const adInputLabels = @json($adInputLabels);
        const adInputDescriptions = @json($adInputDescriptions);

        function changeLabelsAndDescriptionsTo(adType) {
            fieldIds.forEach(fieldId => {
                document.getElementById(fieldId + "Label").innerHTML = adInputLabels[adTypeKeys[adType] + fieldId];
                document.getElementById(fieldId + "Description").innerHTML = adInputDescriptions[adTypeKeys[
                    adType] + fieldId];
            });
        }

        function showForm() {
            document.getElementById('relatedAdsDiv').classList.remove('hidden');
            document.getElementById('submitButton').classList.remove('hidden');
            fieldIds.forEach(fieldId => {
                document.getElementById(fieldId).classList.remove('hidden');
            });
        }
    </script>
@endsection
