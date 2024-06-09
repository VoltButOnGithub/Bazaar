@props(['leases'])

<div class="flex w-full flex-col items-center text-center">
    @if ($leases->count() < 1)
        <p class="mt-4 text-xl">{{ __('global.nothing_to_display') }}</p>
    @else
        <div class="flex-col">
            @foreach ($leases as $lease)
                <x-leases.lease :lease='$lease' />
            @endforeach
        </div>
    @endif

    {{ $leases->appends(['renting_out_page' => old('renting_out_page'), 'renting_page' => old('renting_page')])->links() }}
</div>
<script>
    function submitForm() {
        document.getElementById("queryForm").submit();
    }
</script>
