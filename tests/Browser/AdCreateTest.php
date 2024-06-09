<?php

use App\Enum\AdTypesEnum;
use App\Models\Ad;
use App\Models\User;
use Laravel\Dusk\Browser;

it('can be navigated to', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $browser
            ->loginAs($user->id)
            ->visit('/')
            ->clickLink(__('global.create_ad'))
            ->assertTitle(__('global.create_ad'));
    });
});

it('can create an ad', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $ad = Ad::factory()->make();
        $browser
            ->loginAs($user->id)
            ->visit('/ad/create')
            ->click('label[for="ad_type0"]')
            ->type('ad_name', $ad->name)
            ->type('ad_description', $ad->description)
            ->type('ad_price', $ad->price)
            ->press(__('global.create_ad'))

            ->assertSee(__('global.ad_stored'));
    });
});

it('cant create an ad with malformed data', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $ad = Ad::factory()->make();
        $browser
            ->loginAs($user->id)
            ->visit('/ad/create')
            ->click('label[for="ad_type0"]')
            ->type('ad_name', fake()->realTextBetween(26, 30))
            ->type('ad_description', fake()->realTextBetween(2501, 2600))
            ->type('ad_price', '-1')
            ->press(__('global.create_ad'))
            ->assertSee(__('global.error_try_again'))
            ->click('label[for="ad_type0"]')
            ->assertSee(__('validation.max.string', ['attribute' => 'ad name', 'max' => 25]))
            ->assertSee(__('validation.max.string', ['attribute' => 'ad description', 'max' => 2500]));
    });
});

it('cant create an ad with missing data', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $ad = Ad::factory()->make();
        $browser
            ->loginAs($user->id)
            ->visit('/ad/create')
            ->click('label[for="ad_type0"]')
            ->press(__('global.create_ad'))
            ->assertTitle(__('global.create_ad'));
    });
});

it('cant create more than 4 ads of the same type', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $ad = Ad::factory()
            ->count(5)
            ->create(['type' => AdTypesEnum::SALE, 'user_id' => $user->id]);
        $ad = Ad::factory()->make(['type' => AdTypesEnum::SALE]);
        $browser
            ->loginAs($user->id)
            ->visit('/ad/create')
            ->click('label[for="ad_type0"]')
            ->type('ad_name', $ad->name)
            ->type('ad_description', $ad->description)
            ->type('ad_price', $ad->price)
            ->press(__('global.create_ad'))

            ->assertTitle(__('global.create_ad'))
            ->assertSee(__('global.max_ads_of_type', ['type' => AdTypesEnum::SALE->getLabel()]));
    });
});
