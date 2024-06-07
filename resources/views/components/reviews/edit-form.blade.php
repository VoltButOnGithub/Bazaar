@props(['id', 'type', 'review'])

<form action="{{ route('review.update', $review->id) }}" method="POST" class='rounded border p-2'>
    @csrf
    <div class="flex items-center justify-between">
        <h1 class='mb-2 border-gray-500 text-2xl font-semibold'>{{ __('global.edit_review') }}</h1>
        <x-nav.menu-button :href="route('review.delete', $review->id)" color="red" icon='heroicon-s-trash' :text="__('global.delete_review')" />
    </div>

    <x-forms.textarea-input id="message" for="message" :label="__('global.message')" :description="__('global.message_description')" rows='2'
                            :value="$review->message" />
    <label for="star-input"
           class="text-wrap block w-72 text-sm font-bold text-gray-700">{{ __('global.rating') }}</label>
    <p class="text-wrap mb-2 w-72 text-xs">{{ __('global.rating_description') }}</p>
    <div class='mb-3 flex cursor-pointer'>
        @for ($i = 1; $i < 6; $i++)
            <x-heroicon-s-star id='sStar{{ $i }}' class="star hidden h-8 w-8 text-yellow-500"
                               :value="$i" />
            <x-heroicon-o-star id='oStar{{ $i }}' class="star h-8 w-8 text-yellow-500" :value="$i" />
        @endfor
    </div>
    <input type="hidden" id="star-input" name="stars" value="{{ $review->stars }}" required>

    <x-forms.submit-button :text="__('global.edit_review')" />
</form>

<script>
    const stars = document.querySelectorAll('.star');
    const starInput = document.getElementById('star-input');
    updateStars(starInput.value);

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = star.getAttribute('value');
            starInput.value = value;
            updateStars(value);
        });
    });

    function updateStars(rating) {
        for (i = 1; i < 6; i++) {
            if (i <= rating) {
                document.getElementById('oStar' + i).classList.add('hidden');
                document.getElementById('sStar' + i).classList.remove('hidden');
            } else {
                document.getElementById('oStar' + i).classList.remove('hidden');
                document.getElementById('sStar' + i).classList.add('hidden');
            }
        }
    }
</script>
