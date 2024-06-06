@props(['href', 'icon', 'text' => '', 'classes' => 'h-5 w-5', 'color' => 'gray'])

<a href="{{ $href }}"
   class="bg-{{ $color }}-600 hover:bg-{{ $color }}-700 flex items-center rounded-md px-3 py-3 text-sm font-medium text-white">
    <x-dynamic-component :component="$icon" class="{{$classes}}" />
    @if($text)
    <span class="ml-2 hidden md:block">{{ $text }}</span>
    @endif
</a>
