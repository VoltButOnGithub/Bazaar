@props(['id'])

<form action="{{ route('ad.rent', $id) }}" method="POST" class='flex-center flex flex-col rounded border p-2'>
    @csrf
    <div class="flex">
        <span
              class="flex items-center rounded border border-gray-300 bg-gray-300 px-3 py-3 text-base text-gray-900">{{ __('global.from') }}</span>
        <input id='startDate'
               type="date"
               name="startDate"
               value="{{ old('startDate') }}"
               min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
               required
               class="@error('startDate') border-red-500 @enderror w-full rounded border px-3 py-3 text-gray-700 shadow focus:border-blue-400">
        <span
              class="flex items-center rounded border border-gray-300 bg-gray-300 px-3 py-3 text-base text-gray-900">{{ __('global.to') }}</span>

        <input id='endDate'
               type="date"
               name="endDate"
               value="{{ old('endDate') }}"
               min="{{ \Carbon\Carbon::now()->addDays(2)->format('Y-m-d') }}"
               required
               class="@error('endDate') border-red-500 @enderror w-full rounded border px-3 py-3 text-gray-700 shadow focus:border-blue-400">

    </div>
    @error('startDate')
        <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
    @enderror
    @error('endDate')
        <p class="mt-2 text-xs italic text-red-500">{{ $message }}</p>
    @enderror
    <x-forms.submit-button :text="__('global.rental_buy')" />
</form>
