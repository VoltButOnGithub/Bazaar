@props(['col', 'type', 'section', 'id', 'ads' => [], 'value'])

<label id="option{{ $col }}-{{ $section }}" for="{{ $id }}"
       class="flex w-80 cursor-pointer flex-col items-center rounded-lg border-4 border-gray-300 p-4 transition duration-200 ease-in-out hover:border-blue-400">
    <div class="flex">
        <input id="{{ $id }}" type="radio"
               name="layout[{{ $col }}][{{ $section }}][0]" class="hidden"
               value='{{ $type }}'
               @if ($value[0] == $type) checked="checked" @endif>

        <div class="flex items-center">
            <div class="text-wrap m-2 w-72 cursor-pointer">
                {{ __('global.layout_' . $type) }}
                <p class="text-wrap w-72 text-xs">{{ __('global.layout_' . $type . '_description') }}</p>
            </div>
        </div>
    </div>
    <div id="extra-input{{ $id }}" class="hidden">
        @if ($type == 'pinned_ad')
            <div
                 class="h-20 w-72 overflow-y-scroll text-gray-700 shadow focus:border-blue-400">
                @foreach ($ads as $ad)
                    <label
                           for="{{ $ad->id }}-{{ $id }}"
                           class="flex items-center border text-gray-700">
                        <input type="radio" id="{{ $ad->id }}-{{ $id }}"
                               name="layout[{{ $col }}][{{ $section }}][pinned_ad]"
                               value="{{ $ad->id }}"
                               class="form-checkbox m-1 h-5 w-5"
                               @if (array_key_exists('pinned_ad', $value) ? $value['pinned_ad'] == $ad->id : false) checked="checked" @endif>
                        {{ $ad->name }}
                    </label>
                @endforeach
            </div>
        @endif
        @if ($type == 'text')
            <x-forms.textarea-input rows='1' id="text{{ $col }}-{{ $section }}" :value="$value['text']"
                                    for="layout[{{ $col }}][{{ $section }}][text]" />
        @endif
        @if ($type == 'image')
            @if (array_key_exists('image', $value))
                <x-forms.fancy-image-input id="image{{ $col }}-{{ $section }}" :value="$value['image']"
                                           for="layout[{{ $col }}][{{ $section }}][image]" />
            @else
                <x-forms.fancy-image-input id="image{{ $col }}-{{ $section }}"
                                           
                                           for="layout[{{ $col }}][{{ $section }}][image]" />
            @endif

        @endif
    </div>
</label>
