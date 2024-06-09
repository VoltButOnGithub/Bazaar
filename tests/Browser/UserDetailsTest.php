<?php

use App\Enum\AdTypesEnum;
use App\Models\Ad;
use App\Models\Review;
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
            ->clickLink($ad->user->name)
            ->assertTitle($ad->user->name);
    });
});

it('shows the ads of the user', function () {
    $this->browse(function (Browser $browser) {
        $ad = Ad::factory()->create();

        $browser
            ->visitRoute('user.show', $ad->user->id)
            ->assertSee($ad->name);
    });
});

it('shows the reviews on the user', function () {
    $this->browse(function (Browser $browser) {
        $reviewer = User::factory()->create();
        $user = User::factory()->create();
        $review = Review::factory()->create(['reviewer_id' => $reviewer->id, 'user_id' => $user->id]);

        $browser
            ->visitRoute('user.show', $user->id)
            ->assertSee($reviewer->name)
            ->assertSee($review->message);
    });
});

it('shows the details of the user', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();

        $browser
            ->visitRoute('user.show', $user->id)
            ->assertSee($user->name)
            ->assertSee($user->username)
            ->assertSee($user->rating);
    });
});

it('shows the profile settings button if own page', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $browser->loginAs($user->id)
            ->visitRoute('user.show', $user->id)
            ->assertSee(__('global.profile_settings'));
    });
});

it('does not show the profile settings button if not own page', function () {
    $this->browse(function (Browser $browser) {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $browser->loginAs($user1->id)
            ->visitRoute('user.show', $user2->id)
            ->assertDontSee(__('global.profile_settings'));
    });
});