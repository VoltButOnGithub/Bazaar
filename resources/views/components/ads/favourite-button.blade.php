@props(['adId'])

@auth
    @if (auth()->user()->hasFavourited($adId))
        <x-nav.menu-button :href="route('ad.unfavourite', $adId)" classes="h-10 w-10 text-red-300" icon="heroicon-s-heart" :text="__('global.unfavourite')" />
    @else
        <x-nav.menu-button :href="route('ad.favourite', $adId)" classes="h-10 w-10" icon="heroicon-o-heart" :text="__('global.favourite')" />
    @endif
@endauth
