<?php

use App\Enum\UserTypesEnum;
use App\Models\User;
use Laravel\Dusk\Browser;

it('can be navigated to', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create(['type' => UserTypesEnum::ADMIN]);
        $browser
            ->loginAs($user->id)
            ->visit('/')
            ->clickLink(__('global.contracts'))
            ->assertTitle(__('global.contracts'));
    });
});
