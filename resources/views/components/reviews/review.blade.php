@props(['review'])

<div class="flex flex-col rounded-lg border bg-white p-6 shadow-xl">
    <div class='flex justify-between'>
        <a href='{{ route('user.show', $review->reviewer->id) }}' class='flex items-center'>
            <img
                 src='{{ $review->reviewer->image ? Storage::url($review->reviewer->image) : __('global.no_image_placeholder') }}'
                 class="m-2 h-12 w-12 rounded" />
            <div class="flex flex-col justify-center">
                <span class="text-l mb-2 font-bold">{{ $review->reviewer->name }}</span>
                <span class="mb-2 text-xs font-bold text-gray-500">{{ $review->reviewer->username }}</span>
            </div>
        </a>
        <div class="flex items-center">
            <x-reviews.rating-full :rating='$review->stars' />
        </div>
    </div>
    <div class='flex justify-between'>
        <p>{{ $review->message }} </p>
        <span class='rounded border'>{{ date('d-m-Y', strtotime($review->updated_at)) }}</span>
    </div>
</div>
