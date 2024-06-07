@props([
    'ads',
    'route',
    'routeParameter' => '',
    'ad_type',
    'gridClasses' => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4',
])

<div class="flex w-full flex-col items-center text-center">
    <form id="queryForm" method="GET" action="{{ route($route, $routeParameter) }}">
        <div class='flex flex-col md:flex-row'>
            <div class='flex'>
                <span
                      class="flex items-center rounded border border-gray-300 bg-gray-300 px-3 py-3 text-xs text-gray-900">
                    <x-heroicon-s-magnifying-glass class="h-5 w-5" />
                </span>
                <input id="search"
                       type="text"
                       name="search"
                       value="{{ old('search') }}"
                       placeholder="{{ __('global.search') }}"
                       class= 'w-full rounded border px-3 py-2 text-gray-700 shadow focus:border-blue-400'>
            </div>

            <select onchange="submitForm()" name="sort_by"
                    class="flex cursor-pointer items-center rounded-md bg-gray-600 px-3 py-3 text-sm font-medium text-white hover:bg-gray-700">
                <option value="newest" @if (old('sort_by') == 'newest') selected @endif>{{ __('global.newest') }}
                </option>
                <option value="oldest" @if (old('sort_by') == 'oldest') selected @endif>{{ __('global.oldest') }}
                </option>
                <option value="cheapest" @if (old('sort_by') == 'cheapest') selected @endif>
                    {{ __('global.cheapest') }}
                </option>
                <option value="most_expensive" @if (old('sort_by') == 'most_expensive') selected @endif>
                    {{ __('global.most_expensive') }}</option>
            </select>
            <select onchange="submitForm()" name="ad_type"
                    class="flex cursor-pointer items-center rounded-md bg-gray-600 px-3 py-3 text-sm font-medium text-white hover:bg-gray-700">
                <option value="all" @if (old('ad_type') == 'all') selected @endif>
                    {{ __('global.all_categories') }}
                </option>
                @foreach (\App\Enum\AdTypesEnum::cases() as $ad_t)
                    <option class="text-l" value={{ $ad_t }}
                            @if ($ad_type != 'all' && old('ad_type') == $ad_t->value) selected @endif> {{ $ad_t->getLabel() }}</option>
                @endforeach
            </select>
        </div>

    </form>
    @if ($ads->count() < 1)
        <p class="mt-4 text-xl">{{ __('global.no_ads_to_display') }}</p>
    @else
        <div class="{{ $gridClasses }} grid">
            @foreach ($ads as $ad)
                <x-ads.card-small :ad='$ad' />
            @endforeach
        </div>
    @endif

    {{ $ads->appends(['search' => old('search'), 'ad_type' => $ad_type, 'sort_by' => old('sort_by')])->links() }}
</div>
<script>
    function submitForm() {
        document.getElementById("queryForm").submit();
    }
</script>
