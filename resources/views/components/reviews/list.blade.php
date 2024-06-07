@props(['reviews', 'rating', 'amount', 'hasForm' => 'true', 'id' => '', 'type', 'appends'])

<div class='flex justify-between'>
    <h2 class="mb-2 border-gray-500 text-2xl font-semibold">{{ __('global.reviews') }}</h2>
    <a id='reviews'></a>
    <x-reviews.rating-full :rating='$rating' :amount='$amount' showAvg='true' />
</div>
@if ($reviews->count() < 1)
    <p>{{ __('global.'.$type.'_has_no_reviews') }}</p>
@else
    <div class='flex flex-col'>
        @foreach ($reviews as $review)
            <x-reviews.review :review="$review" />
        @endforeach
        {{ $reviews->appends(['search' => old('search'), 'ad_type' => old('ad_type'), 'sort_by' => old('sort_by'), 'page' => old('page')])->withQueryString()->fragment('reviews')->links() }}
    </div>
@endif
@if ($hasForm)
    @if (auth()->user()->hasReviewed($id, $type))
        <x-reviews.edit-form :id='$id' :type='$type' :review="auth()->user()->getReviewOn($id, $type)" />
    @else
        <x-reviews.create-form :id='$id' :type='$type' />
    @endif
@endif
