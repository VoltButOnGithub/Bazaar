<?php

use App\Enum\AdTypesEnum;
use App\Models\Ad;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Dusk\Browser;

it('can be navigated to', function () {
    $this->browse(function (Browser $browser) {

        $ad = Ad::factory()->create();

        $browser
            ->visit('/')
            ->assertSee($ad->name)
            ->clickLink($ad->name)
            ->assertSee($ad->name)
            ->assertTitle($ad->name)
            ->assertSee($ad->description);
    });
});

it('shows details of an auction', function () {
    $ad = Ad::factory()->create(['type' => AdTypesEnum::AUCTION]);
    $this->browse(function (Browser $browser) use ($ad) {
        $browser
            ->visitRoute('ad.show', $ad->id)
            ->assertSee($ad->name)
            ->assertSee($ad->description)
            ->assertSee($ad->type->getPriceLabel($ad->highestBid))
            ->assertSee($ad->user->name)
            ->assertSee($ad->user->username);
    });
});

it('shows details of a sale', function () {
    $ad = Ad::factory()->create(['type' => AdTypesEnum::SALE]);
    $this->browse(function (Browser $browser) use ($ad) {
        $browser
            ->visitRoute('ad.show', $ad->id)
            ->assertSee($ad->name)
            ->assertSee($ad->description)
            ->assertSee($ad->type->getPriceLabel($ad->highestBid))
            ->assertSee($ad->user->name)
            ->assertSee($ad->user->username);
    });
});

it('shows details of a rental', function () {
    $ad = Ad::factory()->create(['type' => AdTypesEnum::RENTAL]);
    $this->browse(function (Browser $browser) use ($ad) {
        $browser
            ->visitRoute('ad.show', $ad->id)
            ->assertSee($ad->name)
            ->assertSee($ad->description)
            ->assertSee($ad->type->getPriceLabel($ad->highestBid))
            ->assertSee($ad->user->name)
            ->assertSee($ad->user->username)
            ->assertSee($ad->rating)
            ->assertSee($ad->reviewAmount);
    });
});

it('can show a QR code', function () {
    $ad = Ad::factory()->create();
    $this->browse(function (Browser $browser) use ($ad) {
        $browser
            ->visitRoute('ad.show', $ad->id)
            ->clickLink(__('global.show_qr'))
            ->assertSee(__('global.back'));
    });
});

it('can be deleted by the owner', function () {
    $ad = Ad::factory()->create();
    $this->browse(function (Browser $browser) use ($ad) {
        $browser->loginAs($ad->user_id)
            ->visitRoute('login')
            ->visitRoute('ad.show', $ad->id)
            ->press(__('global.delete_ad'))
            ->assertSee(__('global.ad_destroyed'));
    });
});

it('cant be deleted by anyone other than the owner', function () {
    $ad = Ad::factory()->create();
    $user = User::factory()->create();
    $this->browse(function (Browser $browser) use ($ad, $user) {
        $browser->loginAs($user)
            ->visitRoute('ad.show', $ad->id)
            ->assertDontSee(__('global.delete_ad'));
    });
});