@props(['ad'])

<a href="{{ route('ad', $ad->id) }}" class="rounded-lg w-64 bg-white p-6 shadow-md flex flex-col">
    <img src="{{ $ad->images ? Storage::url($ad->images[0]) : __('global.no_image_placeholder') }}" class="mb-4 object-contain w-64 h-32 rounded" />
    <div>
        <div class='flex justify-between'>
            <h2 class="mb-2 text-l font-bold border-gray-500">{{ $ad->name }}</h2>
            @if($ad->type->isRental())
            <div class="flex items-center">
                <span class="ml-1">{{ $ad->rating }}</span>
                <span class="text-yellow-500">&#9733;</span>
                <span>({{$ad->reviewAmount}})</span>
            </div>
            @endif
        </div>
        <div class='flex justify-between' >
            <h2 class="mb-2 text-base font-semibold border-gray-500">€ {{ $ad->price }}</h2>
            <x-dynamic-component :component="$ad->type->getIcon()" class="mr-2 h-6 w-6" />
        </div>
    </div>
</a>