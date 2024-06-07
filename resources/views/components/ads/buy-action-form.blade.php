@props(['ad'])

@if ($ad->type->isSale())
    <a href="{{ route('ad.buy', $ad->id) }}"
       class="focus:shadow-outline rounded bg-blue-600 px-6 py-4 text-3xl font-bold text-white hover:bg-blue-700 focus:outline-none">
        {{ $ad->type->getBuyAction() }}
    </a>
@endif
@if ($ad->type->isAuction())
    @if (auth()->user()->isOwnerOf($ad->id))
        <a href="{{ route('ad.finish', $ad->id) }}"
           class="focus:shadow-outline rounded bg-blue-600 px-6 py-4 text-3xl font-bold text-white hover:bg-blue-700 focus:outline-none">
            {{ __('global.finish_auction') }}
        </a>
    @else
        <x-ads.bid-form :id="$ad->id" :type="$ad->type" minValue="{{ $ad->highestBid }}" />
    @endif
@endif
@if ($ad->type->isRental())
    <x-ads.rent-form :id="$ad->id" :type="$ad->type" minValue="{{ $ad->highestBid }}" />
@endif
