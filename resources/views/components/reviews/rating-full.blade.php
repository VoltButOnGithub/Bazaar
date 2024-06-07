@props(['rating', 'amount' => '', 'showAvg' => false])

<div class="flex items-center">
    @if($showAvg)
        <span class="ml-1">{{ $rating }}</span>
    @endif
    @for ($i = 0; $i < $rating; $i++)
        <x-heroicon-s-star class='h-5 w-5 text-yellow-500' />
    @endfor
    @for ($i; $i < 5; $i++)
        <x-heroicon-o-star class='h-5 w-5 text-yellow-500' />
    @endfor
    @if ($amount)
        <span>({{ $amount }})</span>
    @endif
</div>
