@props(['id', 'name', 'label','options' => []])

<div class="mb-4">
    <label for="{{ $name }}" class="mb-2 mr-2 block text-sm font-bold text-gray-700">{{ $label }}</label>
    @foreach ($options as $option)
        <x-forms.fancy-radio-button
                                    id="{{ $name . $option->value }}"
                                    name="{{ $name }}"
                                    description="{{ $option->getDescription() }}"
                                    value="{{ $option }}"
                                    icon="{{ $option->getIcon() }}"
                                    label="{{ $option->getLabel() }}" />
    @endforeach
</div>

<script>
    document.querySelectorAll('input[name="{{ $name }}"]').forEach((radio) => {
        radio.checked = false;
        radio.addEventListener('change', function() {
            document.querySelectorAll('input[name="{{ $name }}"]').forEach((r) => {
                if (r.checked) {
                    r.parentElement.classList.add('border-blue-600');
                    r.parentElement.classList.add('font-bold');
                    r.parentElement.classList.remove('border-gray-300');
                    r.parentElement.classList.remove('hover:border-blue-400');
                } else {
                    r.parentElement.classList.remove('border-blue-600');
                    r.parentElement.classList.remove('font-bold');
                    r.parentElement.classList.add('border-gray-300');
                    r.parentElement.classList.add('hover:border-blue-400');
                }
            });
        });
    });
</script>
