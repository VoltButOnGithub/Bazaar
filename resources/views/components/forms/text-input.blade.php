@props([
    'id' => '',
    'for',
    'label',
    'type' => 'text',
    'description' => '',
    'value' => '',
    'prefix' => '',
    'required' => false,
    'classes' => '',
])

<div id="{{ $id }}" class="{{ $classes }} mb-4">
    <label id="{{ $id }}Label" for="{{ $for }}"
           class="text-wrap block w-72 text-sm font-bold text-gray-700">{{ $label }}</label>
    <p id="{{ $id }}Description" class="text-wrap mb-2 w-72 text-xs">{{ $description }}</p>
    <div class="flex">
        @if ($prefix)
            <span
                  class="flex items-center rounded border border-gray-300 bg-gray-300 px-3 py-2 text-xs text-gray-900">{{ $prefix }}</span>
        @endif
        <input id="{{ $for }}"
               type="{{ $type }}"
               name="{{ $for }}"
               value="{{ $value ? $value : old($for)}}"
               required="{{ $required }}"
               class="@error($for) border-red-500 @enderror w-full rounded border px-3 py-2 text-gray-700 shadow focus:border-blue-400">
    </div>

    @error($for)
        <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
    @enderror
</div>
