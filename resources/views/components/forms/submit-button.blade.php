@props(['text', 'id' => '', 'classes' => ''])

<button id="{{ $id }}" type="submit"
        class="focus:shadow-outline {{ $classes }} rounded bg-blue-600 px-5 py-3 font-bold text-white hover:bg-blue-700 focus:outline-none">
    {{ $text }}
</button>
