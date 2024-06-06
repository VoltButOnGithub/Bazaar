@props(['adId'])

@if (auth()->check())
    <div>
        @if (auth()->user()->hasFavourited($adId))
            <x-nav.menu-button :href="route('ad.unfavourite', $adId)" classes="h-10 w-10" icon="heroicon-s-heart" />
        @else
            <x-nav.menu-button :href="route('ad.favourite', $adId)" classes="h-10 w-10" icon="heroicon-o-heart" />
        @endif
    </div>
@endif
