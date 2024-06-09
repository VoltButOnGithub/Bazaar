<?php

use App\Enum\AdTypesEnum;
use App\Models\Ad;
use App\Models\Lease;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Dusk\Browser;

it('can be navigated to', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $browser
            ->loginAs($user->id)
            ->visit('/')
            ->clickLink(__('global.settings'))
            ->assertTitle(__('global.settings'));
    });
});

it('shows active ads', function () {
    $this->browse(function (Browser $browser) {
        $ad = Ad::factory()->create();
        $browser
            ->loginAs($ad->user_id)
            ->visit('/settings/active-ads')
            ->assertSee($ad->name);
    });
});

it('shows bought ads', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $ad = Ad::factory()->create(['buyer_id' => $user->id]);
        $browser
            ->loginAs($user->id)
            ->visit('/settings/bought-ads')
            ->assertSee($ad->name);
    });
});

it('shows sold ads', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $ad = Ad::factory()->create(['buyer_id' => $user->id]);
        $browser
            ->loginAs($ad->user_id)
            ->visit('/settings/sold-ads')
            ->assertSee($ad->name);
    });
});

it('shows leases ads', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $ad = Ad::factory()->create(['buyer_id' => $user->id]);
        $lease = Lease::factory()->create(['ad_id' => $ad->id, 'user_id' => $user->id]);
        $browser
            ->loginAs($ad->user_id)
            ->visit('/settings/calendar')
            ->assertSee($lease->ad->name);
    });
});

it('shows rented ads', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $ad = Ad::factory()->create(['buyer_id' => $user->id]);
        $lease = Lease::factory()->create(['ad_id' => $ad->id, 'user_id' => $user->id]);
        $browser
            ->loginAs($user->id)
            ->visit('/settings/calendar')
            ->assertSee($lease->ad->name);
    });
});

it('shows favourited ads', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $ad = Ad::factory()->create(['buyer_id' => $user->id]);
        $user->favourites()->attach($ad->id);
        $browser
            ->loginAs($user->id)
            ->visit('/settings/favourites')
            ->assertSee($ad->name);
    });
});