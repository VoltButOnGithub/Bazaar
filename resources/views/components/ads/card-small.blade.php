@props(['ad'])

<a href="{{ route('ad.show', $ad->id) }}" class="rounded-lg col-span-1 w-64 bg-white p-6 shadow-md flex flex-col">
    <img src="{{ $ad->images ? Storage::url($ad->images[0]) : __('global.no_image_placeholder') }}" class="mb-4 object-contain w-64 h-32 rounded" />
    <div>
        <div class='flex justify-between'>
            <h2 class="mb-2 text-left text-l font-bold border-gray-500">{{ $ad->name }}</h2>
            @if($ad->type->isRental())
            <x-reviews.rating-small :rating="$ad->rating" :amount="$ad->reviewAmount" />
            @endif
        </div>
        <div class='flex justify-between' >
            <h2 class="mb-2 text-base font-semibold border-gray-500">€ {{ $ad->highestBid }}</h2>
            <x-dynamic-component :component="$ad->type->getIcon()" class="mr-2 h-6 w-6" />
        </div>
    </div>
</a>