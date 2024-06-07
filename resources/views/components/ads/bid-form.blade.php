@props(['id', 'minValue'])

<form action="{{ route('ad.bid', $id) }}" method="POST" class='flex-centerborder flex rounded p-2'>
    @csrf
    <div class="flex">
        <span
              class="flex items-center rounded border border-gray-300 bg-gray-300 px-3 py-3 text-base text-gray-900">€</span>
        <input id='bidInput'
               type="text"
               name="bid"
               oninput="validateEuroAmount(event)"
               onblur="formatEuroAmount(event)"
               value="{{ old('bid') }}"
               required
               class="@error('bid') border-red-500 @enderror w-full rounded border px-3 py-3 text-gray-700 shadow focus:border-blue-400">

    </div>

    <x-forms.submit-button :text="__('global.auction_buy')" />
</form>

<script>
    const minValue = {{ $minValue }}

    function formatEuroAmount(event) {
        let input = document.getElementById('bidInput');
        let value = parseFloat(input.value).toFixed(2);
        if (value > 10000000) {
            value = 10000000;
        }
        if (value < minValue) {
            value = minValue+1;
        }
        if (!isNaN(value)) {
            input.value = value;
        }
    }

    function validateEuroAmount(event) {
        let input = event.target;
        const allowedPattern = /[^0-9.]/g;

        input.value = input.value.replace(allowedPattern, '');
    }
</script>
