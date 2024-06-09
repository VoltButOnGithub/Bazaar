<?php

use App\Enum\AdTypesEnum;
use App\Models\Ad;
use Carbon\Carbon;
use Laravel\Dusk\Browser;

it('shows ads', function () {
    $ad = Ad::factory()->create();
    $this->browse(function (Browser $browser) use ($ad) {
        $browser
            ->visit('/')
            ->assertSee($ad->name)
            ->assertPathIs('/');
    });
});

it('can filter ads', function () {
    $this->browse(function (Browser $browser) {
        $ad = Ad::factory()->create();
        Ad::factory()->count(10)->create();
        $browser
            ->visit('/')
            ->type('search', $ad->name)
            ->keys('input[name="search"]', '{enter}')
            ->clear('search')
            ->assertSee($ad->name)
            ->assertPathIs('/');
    });
});

it('can sort ads by oldest', function () {
    $this->browse(function (Browser $browser) {
        $ad = Ad::factory()->create(['created_at' => Carbon::yesterday()]);
        Ad::factory()->count(10)->create();
        $browser
            ->visit('/')
            ->assertDontSee($ad->name)
            ->select('sort_by', 'oldest')
            ->keys('input[name="search"]', '{enter}')
            ->assertSee($ad->name)
            ->assertPathIs('/');
    });
});

it('can sort ads by cheapest', function () {
    $this->browse(function (Browser $browser) {
        $ad = Ad::factory()->create(['price' => 1, 'created_at' => Carbon::yesterday()]);
        Ad::factory()->count(10)->create(['price' => 10]);
        $browser
            ->visit('/')
            ->assertDontSee($ad->name)
            ->select('sort_by', 'cheapest')
            ->keys('input[name="search"]', '{enter}')
            ->assertSee($ad->name)
            ->assertPathIs('/');
    });
});

it('can sort ads by most expensive', function () {
    $this->browse(function (Browser $browser) {
        $ad = Ad::factory()->create(['price' => 10, 'created_at' => Carbon::yesterday()]);
        Ad::factory()->count(10)->create(['price' => 1]);
        $browser
            ->visit('/')
            ->assertDontSee($ad->name)
            ->select('sort_by', 'most_expensive')
            ->keys('input[name="search"]', '{enter}')
            ->assertSee($ad->name)
            ->assertPathIs('/');
    });
});

it('can filter by by sale', function () {
    $this->browse(function (Browser $browser) {
        $ad = Ad::factory()->create(['type' => AdTypesEnum::SALE, 'created_at' => Carbon::yesterday()]);
        Ad::factory()->count(10)->create(['type' => AdTypesEnum::AUCTION]);
        $browser
            ->visit('/')
            ->assertDontSee($ad->name)
            ->select('ad_type', AdTypesEnum::SALE->value)
            ->keys('input[name="search"]', '{enter}')
            ->assertSee($ad->name)
            ->assertPathIs('/');
    });
});
