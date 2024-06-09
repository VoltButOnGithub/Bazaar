<?php

use App\Enum\AdTypesEnum;
use App\Enum\UserTypesEnum;
use App\Models\Ad;
use App\Models\Business;
use App\Models\Lease;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Dusk\Browser;

it('shows buttons for admins', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create(['type' => UserTypesEnum::ADMIN]);
        $browser
            ->loginAs($user->id)
            ->visit('/')
            ->assertSee(__('global.contracts'))
            ->assertSee(__('global.logout'))
            ->assertSee(__('global.en'));
    });
});

it('shows buttons for logged in users', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create(['type' => UserTypesEnum::INDIVIDUAL]);
        $browser
            ->loginAs($user->id)
            ->visit('/')
            ->assertSee(__('global.logout'))
            ->assertSee(__('global.settings'))
            ->assertSee(__('global.profile'))
            ->assertSee(__('global.create_ad'))
            ->assertSee(__('global.en'));
    });
});

it('shows buttons for guest users', function () {
    $this->browse(function (Browser $browser) {
        $browser
            ->visit('/')
            ->assertSee(__('global.login'))
            ->assertSee(__('global.en'));
    });
});

it('allows users to change language', function () {
    $this->browse(function (Browser $browser) {
        $browser
            ->visit('/')
            ->select('lang', 'nl')
            ->assertSee(__('global.login', [], 'nl'))
            ->assertSee(__('global.nl', [], 'nl'));
    });
});