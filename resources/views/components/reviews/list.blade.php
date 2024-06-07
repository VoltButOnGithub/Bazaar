@props(['reviews', 'rating', 'amount', 'hasForm' => 'true', 'id' => '', 'type'])

<div class='flex justify-between'>
    <h2 class="mb-2 border-gray-500 text-2xl font-semibold">{{ __('global.reviews') }}</h2>
    <x-reviews.rating-full :rating='$rating' :amount='$amount' showAvg='true' />
</div>
<div class='flex flex-col'>
    @foreach ($reviews as $review)
        <x-reviews.review :review="$review" />
    @endforeach
    {{ $reviews->links() }}
</div>
@if ($hasForm)
    @if (auth()->user()->hasReviewed($id, $type))
        <x-reviews.edit-form :id='$id' :type='$type' :review="auth()->user()->getReviewOn($id, $type)"/>
    @else
        <x-reviews.create-form :id='$id' :type='$type' />
    @endif

@endif
