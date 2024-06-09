@props(['ads', 'col', 'section', 'value'])

<div class="m-2 border-4 p-2">
    <label class="mb-2 mr-2 block text-sm font-bold text-gray-700">{{ __('global.layout_item') }}
        {{ $section }}</label>

    <x-businesses.layout-option col="{{ $col }}" section='{{ $section }}' type='nothing' :value="$value"

                                id='{{ $col }}-{{ $section }}-0' />
    <x-businesses.layout-option col="{{ $col }}" section='{{ $section }}' type='ads' :value="$value"
                                id='{{ $col }}-{{ $section }}-1' />
    <x-businesses.layout-option col="{{ $col }}" section='{{ $section }}' type='reviews'
                                :value="$value"
                                id='{{ $col }}-{{ $section }}-2' />
    <x-businesses.layout-option col="{{ $col }}" section='{{ $section }}' type='pinned_ad'
                                :value="$value"
                                id='{{ $col }}-{{ $section }}-3'
                                :ads="$ads" />
    <x-businesses.layout-option col="{{ $col }}" section='{{ $section }}' type='text'
                                :value="$value"
                                id='{{ $col }}-{{ $section }}-4' />
    <x-businesses.layout-option col="{{ $col }}" section='{{ $section }}' type='image'
                                :value="$value"
                                id='{{ $col }}-{{ $section }}-5' />
</div>
<script>
    updateRadios();
    document.querySelectorAll('input[name="layout[{{ $col }}][{{ $section }}][0]"]').forEach((
        radio) => {
        radio.addEventListener('change', updateRadios);
    });

    function updateRadios() {
        document.querySelectorAll(
                'input[name="layout[{{ $col }}][{{ $section }}][0]"]')
            .forEach((r) => {
                updateRadio(r);
            });
    }

    function updateRadio(radio) {
        if (radio.checked) {
            document.getElementById('extra-input' + radio.id).classList.remove('hidden');
            radio.parentElement.parentElement.classList.add('border-blue-600');
            radio.parentElement.parentElement.classList.add('font-bold');
            radio.parentElement.parentElement.classList.remove('border-gray-300');
            radio.parentElement.parentElement.classList.remove('hover:border-blue-400');
        } else {
            document.getElementById('extra-input' + radio.id).classList.add('hidden');
            radio.parentElement.parentElement.classList.remove('border-blue-600');
            radio.parentElement.parentElement.classList.remove('font-bold');
            radio.parentElement.parentElement.classList.add('border-gray-300');
            radio.parentElement.parentElement.classList.add('hover:border-blue-400');
        }
    }
</script>
