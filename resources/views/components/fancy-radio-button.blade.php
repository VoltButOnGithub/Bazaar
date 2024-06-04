@props(['id', 'name', 'value', 'description' , 'checked' => false, 'icon', 'onchange' => "",'label'])


<label for="{{ $id }}" class="flex items-center p-4 w-72 border-2 rounded-lg cursor-pointer transition duration-200 ease-in-out border-gray-300 hover:border-blue-400 border-4">
    <input type="radio" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" onchange="{{ $onchange }}" class="hidden">
    <div class="flex items-center">
        <x-dynamic-component :component="$icon" class="w-6 h-6 mr-2"/>
        <div class="cursor-pointer">
            {{ $label }}
            <p class="text-xs">{{$description}}</p>
        </div>
    </div>
</label>

<script defer>
    document.getElementById("{{ $id }}").checked = false;
    document.getElementById("{{ $id }}").addEventListener('change', function () {
        document.querySelectorAll('input[name="{{ $name }}"]').forEach((r) => {
            if (r.checked) {
                r.parentElement.classList.add('border-blue-600');
                r.parentElement.classList.add('font-bold');
                r.parentElement.classList.remove('border-gray-300');
                r.parentElement.classList.remove('hover:border-blue-400');
            }
            else 
            {
                r.parentElement.classList.remove('border-blue-600');    
                r.parentElement.classList.remove('font-bold');
                r.parentElement.classList.add('border-gray-300');
                r.parentElement.classList.add('hover:border-blue-400');
            }
            r.onchange();
        });
    });
</script>