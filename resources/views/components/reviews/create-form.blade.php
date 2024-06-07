@props(['id', 'type'])

<form action="{{ route('review.' . $type . '_create', $id) }}" method="POST" class='rounded border p-2'>
    @csrf
    <h1 class='mb-2 border-gray-500 text-2xl font-semibold'>{{ __('global.write_review') }}</h1>
    <x-forms.textarea-input id="message" for='message' :value="old('message')" :label="__('global.message')" :description="__('global.message_description')"
                            rows='2' />

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
    @error('stars')
        <p class="mb-2 text-xs italic text-red-500">{{ $message }}</p>
    @enderror

    <input type="hidden" value="{{old('stars')}}" id="star-input" name="stars" required>

    <x-forms.submit-button :text="__('global.post_review')" />
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
