@props(['review'])

<div class="flex flex-col rounded-lg border bg-white p-6 shadow-xl">
    <div class='flex justify-between'>
        <a href='{{ route('user.show', $review->reviewer->id) }}' class='flex items-center'>
            <img
                 src='{{ $review->reviewer->image ? Storage::url($review->reviewer->image) : __('global.no_image_placeholder') }}'
                 class="m-2 h-12 w-12 rounded" />
            <h2 class="text-l mb-2 border-gray-500 font-bold">{{ $review->reviewer->name }}</h2>
        </a>
        <div class="flex items-center">
            <x-reviews.rating-full :rating='$review->stars' />
        </div>
    </div>
    <div class='flex justify-between'>
        <p>{{ $review->message }} </p>
        <span class='border rounded'>{{ date('d-m-Y', strtotime($review->updated_at)) }}</span>
    </div>
</div>
