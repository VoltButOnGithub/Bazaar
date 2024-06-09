@extends('layouts.app')

@section('title', __('global.contracts'))

@section('content')
    <div class="flex w-full flex-col rounded-lg bg-white p-6 shadow-md">
        @if ($contracts->count() > 0)
            @foreach ($contracts as $contract)
                <div class="border-4">
                    <span class="m-4 text-5xl">{{ $contract->title }}</span>
                    <div class="flex flex-row">
                        <x-nav.menu-button :href="route('contract.show', $contract->id)" classes="h-10 w-10" icon="heroicon-s-document"
                                           :text="__('global.export_as_pdf')" />
                        <form action="{{ route('contract.destroy', $contract->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="flex items-center rounded-md bg-red-600 px-3 py-3 text-sm font-medium text-white hover:bg-red-700">
                                <x-heroicon-s-trash class="h-10 w-10" />
                                <span class="ml-2 hidden md:block">{{ __('global.delete_contract') }}</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            {{ $contracts->links() }}
        @else
            <span>{{ __('global.no_contracts_found') }}</span>
        @endif
        <x-nav.menu-button :href="route('contract.create')" icon="heroicon-s-plus" :text="__('global.create_contract')" />
    </div>
@endsection
