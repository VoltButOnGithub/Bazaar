@props(['ad'])

@auth
    @if (!auth()->user()->isOwnerOf($ad->id))
        @if ($ad->type->isSale())
            <a href="{{ route('ad.buy', $ad->id) }}"
               class="focus:shadow-outline rounded bg-blue-600 px-6 py-4 text-3xl font-bold text-white hover:bg-blue-700 focus:outline-none">
                {{ $ad->type->getBuyAction() }}
            </a>
        @endif
        @if ($ad->type->isAuction())
            <x-ads.bid-form :id="$ad->id" :type="$ad->type" minValue="{{ $ad->highestBid }}" />
        @endif
        @if ($ad->type->isRental())
            <x-ads.rent-form :id="$ad->id" :type="$ad->type" minValue="{{ $ad->highestBid }}" />
        @endif
    @else
        @if ($ad->type->isAuction())
            <a href="{{ route('ad.finish', $ad->id) }}"
               class="focus:shadow-outline rounded bg-blue-600 px-6 py-4 text-3xl font-bold text-white hover:bg-blue-700 focus:outline-none">
                {{ __('global.finish_auction') }}
            </a>
        @endif
    @endif
@endauth
@guest
    <x-nav.menu-button :href="route('login')" icon="heroicon-s-user" classes="h-10 y-10" :text="__('global.login_to') . $ad->type->getBuyAction()" color='blue' />
@endguest
