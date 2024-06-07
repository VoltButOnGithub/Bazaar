@props(['for', 'id' => 'image', 'label', 'description', 'value' => ''])

<div class="mb-4">
    <input type="file"
           id="{{ $id }}"
           name="{{ $for }}"
           accept="image/*"
           value="{{ old('image') }}"
           class="@error('image') border-red-500 @enderror hidden w-full rounded border px-3 py-2 text-gray-700 shadow focus:border-blue-400">
    <label for="image" class="text-wrap block w-72 cursor-pointer rounded text-sm font-bold text-gray-700">
        {{ $label }}
        <p class="text-wrap mb-2 w-72 text-xs font-normal">{{ $description }}</p>
        <img id="previewImage" class="h-24 w-24 rounded-lg"
             src="{{ $value ? Storage::url($value) : 'https://placehold.co/100x100?text=Click+to\n+upload+image' }}" />
    </label>
    @error('image')
        <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
    @enderror
</div>

<script>
    document.getElementById("{{ $id }}").addEventListener('change', function() {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('previewImage').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
