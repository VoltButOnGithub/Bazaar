@props(['user'])

<div class="flex flex-col rounded-lg border bg-white p-6 shadow-xl">
    <div class='flex justify-between'>
        <a href='{{ route('user.show', $user->id) }}' class='flex items-center'>
            <img
                 src='{{ $user->image ? Storage::url($user->reviewer->image) : __('global.no_image_placeholder') }}'
                 class="m-2 h-12 w-12 rounded" />
            <div class="flex flex-col">
                <h2 class="text-l mb-2 border-gray-500 font-bold">{{ $user->name }}</h2>
                <x-reviews.rating-full :rating='$user->rating' :amount='$user->reviewAmount' />
            </div>

        </a>

    </div>
</div>
