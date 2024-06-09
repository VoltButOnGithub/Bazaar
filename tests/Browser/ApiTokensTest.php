<?php

use App\Enum\AdTypesEnum;
use App\Enum\UserTypesEnum;
use App\Models\Ad;
use App\Models\Business;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Dusk\Browser;

it('can be navigated to', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create(['type'=> UserTypesEnum::BUSINESS]);
        $business = Business::factory()->create(['user_id' => $user->id]);
        $browser
            ->loginAs($user->id)
            ->visit('/')
            ->clickLink(__('global.settings'))
            ->clickLink(__('global.api_keys'))
            ->assertTitle(__('global.api_keys'));
    });
});

it('can generate a new key', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create(['type'=> UserTypesEnum::BUSINESS]);
        $business = Business::factory()->create(['user_id' => $user->id]);
        $browser
            ->loginAs($user->id)
            ->visit('/settings/business/api')
            ->type('name', 'api_key')
            ->press(__('global.generate_key'))
            ->assertSee(__('global.api_key_generated'));
    });
});

it('can delete a key', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create(['type'=> UserTypesEnum::BUSINESS]);
        $business = Business::factory()->create(['user_id' => $user->id]);
        $user->createToken('token');
        $browser
            ->loginAs($user->id)
            ->visit('/settings/business/api')
            ->clickLink(__('global.destroy_key'))
            ->assertSee(__('global.api_key_destroyed'));
    });
});
