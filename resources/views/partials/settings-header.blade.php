<nav class="bg-gray-300 p-4">
    <div class="container mx-auto flex items-center justify-between">
        <div class="flex space-x-4">
            <x-nav.menu-button :href="route('settings.active_ads')" icon="heroicon-s-building-storefront"
                               :text="__('global.active_ads')" />
            <x-nav.menu-button :href="route('settings.bought_ads')" icon="heroicon-s-arrow-down-tray"
                               :text="__('global.bought_ads')" />
            <x-nav.menu-button :href="route('settings.sold_ads')" icon="heroicon-s-arrow-up-tray"
                               :text="__('global.sold_ads')" />
            <x-nav.menu-button :href="route('settings.calendar')" icon="heroicon-s-calendar"
                               :text="__('global.calendar')" />
            <x-nav.menu-button :href="route('settings.favourites')" icon="heroicon-s-heart"
                               :text="__('global.favourites')" />
            <x-nav.menu-button :href="route('profile.edit')" icon="heroicon-s-cog-6-tooth"
                               :text="__('global.profile_settings')" />
        </div>
    </div>
</nav>
