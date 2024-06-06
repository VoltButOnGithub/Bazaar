@props([
    'id' => '',
    'for',
    'label',
    'type' => 'text',
    'description' => '',
    'required' => false,
    'classes' => '',
])

<div id="{{ $id }}" class="{{ $classes }} mb-4">
    <label id="{{ $id }}Label" for="{{ $for }}"
           class="text-wrap block w-72 text-sm font-bold text-gray-700">{{ $label }}</label>
    <p id="{{ $id }}Description" class="text-wrap mb-2 w-72 text-xs">{{ $description }}</p>
    <div class="flex">
        <span
              class="flex items-center rounded border border-gray-300 bg-gray-300 px-3 py-2 text-base text-gray-900">€</span>
        <input id="{{ $for }}"
               type="text"
               name="{{ $for }}"
               oninput="validateEuroAmount(event)"
               onblur="formatEuroAmount(event)"
               value="{{ old($for) }}"
               required="{{ $required }}"
               class="@error($for) border-red-500 @enderror w-full rounded border px-3 py-2 text-gray-700 shadow focus:border-blue-400">
    </div>

    @error($for)
        <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
    @enderror
</div>

<script>
    function formatEuroAmount(event) {
        let input = document.getElementById('{{ $for }}');
        let value = parseFloat(input.value).toFixed(2);
        if (value > 10000000) {
            value = 10000000;
        }
        if(value < 0.01) {
            value = 0.01;
        }
        if (!isNaN(value)) {
            input.value = value;
        }
    }

    function validateEuroAmount(event) {
        let input = event.target;
        const allowedPattern = /[^0-9.]/g;

        // Remove any characters that are not digits or a decimal point
        input.value = input.value.replace(allowedPattern, '');
    }
</script>
