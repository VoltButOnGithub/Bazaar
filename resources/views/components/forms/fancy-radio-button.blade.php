@props(['id', 'name', 'value', 'description' => '', 'checked', 'icon', 'label' => ''])

<label for="{{ $id }}"
       class="flex w-72 cursor-pointer items-center rounded-lg border-4 border-gray-300 p-4 transition duration-200 ease-in-out hover:border-blue-400">
    <input type="radio" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" class="hidden">
    <div class="flex items-center">
        <x-dynamic-component :component="$icon" class="mr-2 h-6 w-6" />
        <div class="text-wrap w-72 cursor-pointer">
            {{ $label }}
            <p class=" text-wrap w-72 text-xs">{{ $description }}</p>
        </div>
    </div>
</label>
