@extends('layouts.app')

@section('title', __('global.create_ad'))

@section('content')
    <div class="flex flex-col items-center text-center">
        <form id="queryForm" method="GET" action="{{ route('ads') }}">
            <div class='flex flex-col md:flex-row'>
                <div class='flex'>
                    <span
                          class="flex items-center rounded border border-gray-300 bg-gray-300 px-3 py-3 text-xs text-gray-900">
                        <x-heroicon-s-magnifying-glass class="h-5 w-5" />
                    </span>
                    <input id="search"
                           type="text"
                           name="search"
                           value="{{old('search')}}"
                           placeholder="{{ __('global.search') }}"
                           class= 'w-full rounded border px-3 py-2 text-gray-700 shadow focus:border-blue-400'>
                </div>

                <select name="sort_by"
                        class="flex cursor-pointer items-center rounded-md bg-gray-600 px-3 py-3 text-sm font-medium text-white hover:bg-gray-700">
                    <option value="newest" @if (old('sort_by') == 'newest') selected @endif>{{ __('global.newest') }}
                    </option>
                    <option value="oldest" @if (old('sort_by') == 'oldest') selected @endif>{{ __('global.oldest') }}
                    </option>
                    <option value="cheapest" @if (old('sort_by') == 'cheapest') selected @endif>{{ __('global.cheapest') }}
                    </option>
                    <option value="most_expensive" @if (old('sort_by') == 'most_expensive') selected @endif>
                        {{ __('global.most_expensive') }}</option>
                </select>
                <select name="ad_type"
                        class="flex cursor-pointer items-center rounded-md bg-gray-600 px-3 py-3 text-sm font-medium text-white hover:bg-gray-700">
                    <option value="all" @if (old('ad_type') == 'all') selected @endif>
                        {{ __('global.all_categories') }}
                    </option>
                    @foreach (\App\Enum\AdTypesEnum::cases() as $ad_t)
                        <option class="text-l" value={{ $ad_t }}
                                @if ($ad_type!='all' && old('ad_type') == $ad_t->value) selected @endif> {{ $ad_t->getLabel() }}</option>
                    @endforeach
                </select>
                <x-forms.submit-button classes="w-18 text-sm md:w-64" :text="__('global.apply_filters')" />
            </div>

        </form>
        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5">
            @foreach ($ads as $ad)
                <x-ads.card-small :ad='$ad' />
            @endforeach
        </div>

        {{ $ads->appends(['search' => old('search'), 'ad_type' => $ad_type, 'sort_by' => old('sort_by')])->links() }}
    </div>
@endsection
