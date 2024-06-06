@props(['for', 'id' => 'image', 'label', 'description', 'amount' => 5, 'classes' => ''])

<div id="{{ $id }}" class="{{ $classes }} mb-4">
    <input type="file"
           id="{{ $for }}"
           name="{{ $for }}"
           accept="image/*"
           multiple
           value="{{ old('image') }}"
           class="@error('image') border-red-500 @enderror hidden w-full rounded border px-3 py-2 text-gray-700 shadow focus:border-blue-400">
    <label id="{{ $id }}Label" for="{{ $for }}"
           class="block cursor-pointer rounded text-sm font-bold text-gray-700">
        {{ $label }}
    </label>
    <label for="{{ $for }}" class="block cursor-pointer rounded text-wrap w-72 text-sm font-bold text-gray-700">
        <p id="{{ $id }}Description" class="mb-2 text-warp w-72 text-xs font-normal">{{ $description }}</p>
        <div class="flex w-72 overflow-x-scroll">
            @for ($i = 0; $i < $amount; $i++)
                <img id="previewImage{{ $id }}{{ $i }}" class="h-24 w-24 rounded-lg"
                     src="https://placehold.co/100x100?text=Click+to\n+upload+image" />
            @endfor
        </div>
    </label>
    @error('image')
        <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
    @enderror
    <p id="tooManyImages{{ $id }}" class="mt-2 hidden text-xs italic text-red-500">
        {{ __('global.too_many_images', ['amount' => $amount]) }}</p>
</div>

<script>
    document.getElementById("{{ $id }}").addEventListener('change', function() {
        var files = event.target.files;
        if (files.length > {{ $amount }}) {
            document.getElementById("tooManyImages{{ $id }}").classList.remove('hidden');
            return;
        } else {
            document.getElementById("tooManyImages{{ $id }}").classList.add('hidden');
        }
        for (let i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            reader.addEventListener('load', function(f) {
                var output = document.getElementById('previewImage{{ $id }}' + i).src = f
                    .target.result;
            });
            reader.readAsDataURL(file);
        };
    });
</script>
