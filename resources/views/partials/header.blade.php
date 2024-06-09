<nav class="bg-gray-400 p-4">
    <div class="container mx-auto flex items-center justify-between">
        <div class="text-lg font-bold text-black">
            <a href="{{ url('/') }}">{{ __('global.bazaar') }}</a>
        </div>

        <div class="flex space-x-4">

            @guest
                <x-nav.menu-button :href="route('login')" icon="heroicon-s-user" :text="__('global.login')" color='blue' />
            @endguest
            @auth
                <x-nav.menu-button :href="route('logout')" icon="heroicon-s-arrow-left-start-on-rectangle"
                                   :text="__('global.logout')" />
                @if (Auth::user()->type->isAdmin())
                <x-nav.menu-button :href="route('contract.index')" icon="heroicon-s-clipboard-document-list"
                                   :text="__('global.contracts')" />
                @else
                    <x-nav.menu-button :href="route('settings.active_ads')" icon="heroicon-s-cog-6-tooth" :text="__('global.settings')" />
                    <x-nav.menu-button :href="route('user.show', Auth::user()->id)" icon="heroicon-s-user" :text="__('global.profile')" />
                    <x-nav.menu-button :href="route('ad.create')" icon="heroicon-s-pencil-square" :text="__('global.create_ad')" color='blue' />
                @endif
            @endauth
            <form id="languageForm" action="{{ route('change_lang') }}" method="post">
                @csrf
                <select name="lang"
                        class="flex cursor-pointer items-center rounded-md bg-gray-600 px-3 py-3 text-sm font-medium text-white hover:bg-gray-700"
                        onchange="submitLangForm()">

                    @foreach (config('app.locales') as $locale)
                        <option value={{ $locale }}
                                @if ($locale == App::currentLocale()) selected @endif> {{ __('global.' . $locale) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
</nav>

<script>
    function submitLangForm() {
        document.getElementById("languageForm").submit();
    }
</script>
