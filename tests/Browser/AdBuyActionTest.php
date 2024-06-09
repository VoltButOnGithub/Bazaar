<?php

use App\Enum\AdTypesEnum;
use App\Models\Ad;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Dusk\Browser;

it('can bid on an auction', function () {
    $ad = Ad::factory()->create(['type' => AdTypesEnum::AUCTION]);
    $user = User::factory()->create();
    $this->browse(function (Browser $browser) use ($ad, $user) {
        $browser->loginAs($user->id)
            ->visitRoute('ad.show', $ad->id)
            ->type('bid', $ad->price + 2)
            ->press(__('global.bid'))
            ->assertSee(__('global.bid_placed'))
            ->assertSee(__('global.auction_price', ['price' => $ad->price+2]));
    });
});

it('allows owner to finish an auction', function () {
    $ad = Ad::factory()->create(['type' => AdTypesEnum::AUCTION]);
    $this->browse(function (Browser $browser) use ($ad) {
        $browser->loginAs($ad->user_id)
            ->visitRoute('ad.show', $ad->id)
            ->clickLink(__('global.finish_auction'))
            ->assertSee(__('global.auction_finished'));
    });
});

it('shows the buyer of a finished auction to the owner', function () {
    $user = User::factory()->create();
    $ad = Ad::factory()->create(['type' => AdTypesEnum::AUCTION, 'buyer_id' => $user->id]);
    $this->browse(function (Browser $browser) use ($ad, $user) {
        $browser->loginAs($ad->user_id)
            ->visitRoute('ad.show', $ad->id)
            ->assertSee($user->name);
    });
});

it('allows users to buy a sale ad', function () {
    $user = User::factory()->create();
    $ad = Ad::factory()->create(['type' => AdTypesEnum::SALE]);
    $this->browse(function (Browser $browser) use ($ad, $user) {
        $browser->loginAs($user->id)
            ->visitRoute('ad.show', $ad->id)
            ->clickLink(__('global.sale_buy'))
            ->assertSee(__('global.bought'));
    });
});

it('shows the buyer of a bought sale', function () {
    $user = User::factory()->create();
    $ad = Ad::factory()->create(['type' => AdTypesEnum::SALE, 'buyer_id' => $user->id]);
    $this->browse(function (Browser $browser) use ($ad, $user) {
        $browser->loginAs($ad->user_id)
            ->visitRoute('ad.show', $ad->id)
            ->assertSee($user->name);
    });
});