@props(['user'])

<div class="flex flex-col rounded-lg border bg-white p-6 shadow-xl">
    <div class='flex justify-between'>
        <a href='{{ route('user.show', $user->id) }}' class='flex items-center'>
            <img
                 src='{{ $user->image ? Storage::url($user->image) : __('global.no_image_placeholder') }}'
                 class="m-2 h-12 w-12 rounded" />
            <div class="flex flex-col">
                <span class="text-l text-left font-bold">{{ $user->name }}</span>
                <span class=" text-xs text-left text-gray-500 font-bold">{{ $user->username }}</span>
                <x-reviews.rating-full :rating='$user->rating' :amount='$user->reviewAmount' />
            </div>
        </a>
    </div>
</div>
