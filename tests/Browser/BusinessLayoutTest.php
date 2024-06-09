<?php

use App\Enum\AdTypesEnum;
use App\Enum\UserTypesEnum;
use App\Models\Ad;
use App\Models\Business;
use App\Models\Lease;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Dusk\Browser;

it('can show a layout with text, ads, reviews and a pinned ad', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create(['type' => UserTypesEnum::BUSINESS]);
        $ad = Ad::factory()->create(['user_id'=> $user]);
        $text = fake()->realTextBetween(20,30);
        $business = Business::factory()->create([
            'user_id' => $user->id,
            'layout' => [
                '1' => [['0' => 'text', 'text' => $text], ['0' => 'ads'], ['0' => 'reviews']],
                '2' => [['0' => 'pinned_ad', 'pinned_ad' => $ad->id], ['0' => 'nothing'], ['0' => 'nothing']],
            ],
        ]);
        $browser
            ->loginAs($user->id)
            ->visit('/')
            ->clickLink(__('global.profile'))
            ->assertSee(__('global.ads'))
            ->assertSee(__('global.reviews'))
            ->assertSee($text)
            ->assertSee($ad->name);
    });
});

it('can show a layout with just a pinned ad', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create(['type' => UserTypesEnum::BUSINESS]);
        $ad = Ad::factory()->create(['user_id'=> $user]);
        $business = Business::factory()->create([
            'user_id' => $user->id,
            'layout' => [
                '1' => [['0' => 'nothing'], ['0' => 'nothing'], ['0' => 'nothing']],
                '2' => [['0' => 'pinned_ad', 'pinned_ad' => $ad->id], ['0' => 'nothing'], ['0' => 'nothing']],
            ],
        ]);
        $browser
            ->loginAs($user->id)
            ->visit('/')
            ->assertSee($ad->name);
    });
});
