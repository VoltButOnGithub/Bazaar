@props(['rating', 'amount' => ''])

<div class="flex items-center">
    <span class="ml-1">{{ $rating }}</span>
    <x-heroicon-s-star class='h-3 w-3 text-yellow-500' />
    @if ($amount)
        <span>({{ $amount }})</span>
    @endif
</div>
