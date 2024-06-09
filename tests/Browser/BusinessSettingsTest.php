<?php

use App\Enum\UserTypesEnum;
use App\Models\Business;
use App\Models\User;
use Laravel\Dusk\Browser;

it('can be navigated to', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create(['type' => UserTypesEnum::BUSINESS]);
        $business = Business::factory()->create(['user_id' => $user->id]);
        $browser
            ->loginAs($user->id)
            ->visit('/')
            ->clickLink(__('global.settings'))
            ->clickLink(__('global.business_settings'))
            ->assertTitle(__('global.business_settings'));
    });
});

it('can change the layout of a business', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create(['type' => UserTypesEnum::BUSINESS]);
        $business = Business::factory()->create(['user_id' => $user->id]);
        $browser
            ->loginAs($user->id)
            ->visit('/settings/business')
            ->click('label[for="1-0-0"]') // Col 1 item 0 nothing
            ->click('label[for="2-0-0"]') // Col 2 item 0 nothing
            ->press(__('global.update_business'))
            ->clickLink(__('global.profile'))
            ->assertDontSee(__('global.ads'))
            ->assertDontSee(__('global.reviews'));
    });
});

it('can change the name of a business', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create(['type' => UserTypesEnum::BUSINESS]);
        $business = Business::factory()->create(['user_id' => $user->id]);
        $newName = 'new name';
        $browser
            ->loginAs($user->id)
            ->visit('/settings/business')
            ->type('name', $newName)
            ->press(__('global.update_business'))
            ->clickLink(__('global.profile'))
            ->assertSee($newName);
    });
});
