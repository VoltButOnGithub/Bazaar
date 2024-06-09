<?php

use App\Enum\AdTypesEnum;
use App\Models\Ad;
use App\Models\Lease;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Dusk\Browser;

it('can add an ad to favourites', function () {
    $ad = Ad::factory()->create();
    $user = User::factory()->create();
    $this->browse(function (Browser $browser) use ($ad, $user) {
        $browser
            ->loginAs($user)
            ->visitRoute('ad.show', $ad->id)
            ->clickLink(__('global.favourite'))
            ->assertSee(__('global.added_to_favourites'))
            ->visit('/settings/favourites')
            ->assertSee($ad->name);
    });
});

it('cant add a favourited ad to favourites', function () {
    $ad = Ad::factory()->create();
    $user = User::factory()->create();
    $user->favourites()->attach($ad->id);
    $this->browse(function (Browser $browser) use ($ad, $user) {
        $browser
            ->loginAs($user)
            ->visitRoute('ad.show', $ad->id)
            ->assertDontSee(__('global.favourite'));
    });
});

it('cant remove an ad from favourites when its not favourited yet', function () {
    $ad = Ad::factory()->create();
    $user = User::factory()->create();
    $this->browse(function (Browser $browser) use ($ad, $user) {
        $browser
            ->loginAs($user)
            ->visitRoute('ad.show', $ad->id)
            ->assertDontSee(__('global.unfavourite'));
    });
});

it('can remove an ad from favourites', function () {
    $ad = Ad::factory()->create();
    $user = User::factory()->create();
    $user->favourites()->attach($ad->id);
    $this->browse(function (Browser $browser) use ($ad, $user) {
        $browser
            ->loginAs($user)
            ->visitRoute('ad.show', $ad->id)
            ->clickLink(__('global.unfavourite'))
            ->assertSee(__('global.removed_from_favourites'))
            ->visit('/settings/favourites')
            ->assertDontSee($ad->name);
    });
});
