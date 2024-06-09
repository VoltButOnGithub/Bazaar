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
        $user = User::factory()->create(['type'=> UserTypesEnum::ADMIN]);
        $browser
            ->loginAs($user->id)
            ->visit('/')
            ->clickLink(__('global.contracts'))
            ->assertTitle(__('global.contracts'));
    });
});
