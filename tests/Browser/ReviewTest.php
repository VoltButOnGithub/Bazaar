<?php

use App\Enum\AdTypesEnum;
use App\Models\Ad;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Dusk\Browser;

it('shows reviews for rentals', function () {
    $ad = Ad::factory()->create(['type' => AdTypesEnum::RENTAL]);
    $user = User::factory()->create();
    $this->browse(function (Browser $browser) use ($ad, $user) {
        $browser->loginAs($user->id)
            ->visitRoute('ad.show', $ad->id)
            ->assertSee(__('global.reviews'));
    });
});

it('does not show reviews for ads other than rentals', function () {
    $ad = Ad::factory()->create(['type' => AdTypesEnum::AUCTION]);
    $user = User::factory()->create();
    $this->browse(function (Browser $browser) use ($ad, $user) {
        $browser->loginAs($user->id)
            ->visitRoute('ad.show', $ad->id)
            ->assertDontSee(__('global.reviews'));
    });
});

it('can write a review for a rental', function () {
    $ad = Ad::factory()->create(['type' => AdTypesEnum::RENTAL]);
    $user = User::factory()->create();
    $this->browse(function (Browser $browser) use ($ad, $user) {
        $browser->loginAs($user->id)
            ->visitRoute('ad.show', $ad->id)
            ->type('message', fake()->text(100))
            ->click('svg[id="oStar5"]')
            ->press(__('global.post_review'))
            ->assertSee(__('global.review_stored'));
    });
});

it('shows reviews for users', function () {
    $user = User::factory()->create();
    $this->browse(function (Browser $browser) use ($user) {
        $browser->loginAs($user->id)
            ->visitRoute('user.show', $user->id)
            ->assertSee(__('global.reviews'));
    });
});

it('can write a review for a user', function () {
    $user = User::factory()->create();
    $reviewer = User::factory()->create();
    $this->browse(function (Browser $browser) use ($user, $reviewer) {
        $browser->loginAs($reviewer->id)
            ->visitRoute('user.show', $user->id)
            ->type('message', fake()->text(100))
            ->click('svg[id="oStar5"]')
            ->press(__('global.post_review'))
            ->assertSee(__('global.review_stored'));
    });
});

it('cant write a review with missing data', function () {
    $user = User::factory()->create();
    $reviewer = User::factory()->create();
    $this->browse(function (Browser $browser) use ($user, $reviewer) {
        $browser->loginAs($reviewer->id)
            ->visitRoute('user.show', $user->id)
            ->press(__('global.post_review'))
            ->assertSee(__('validation.required', ['attribute' => 'message']))
            ->assertSee(__('validation.required', ['attribute' => 'stars']));
    });
});

it('can edit an existing review', function () {
    $user = User::factory()->create();
    $reviewer = User::factory()->create();
    $review = Review::factory()->create(['user_id' => $user->id, 'reviewer_id' => $reviewer->id, 'stars' => 4]);
    
    $this->browse(function (Browser $browser) use ($user, $reviewer, $review) {
        $browser->loginAs($reviewer->id)
            ->visitRoute('user.show', $user->id)
            ->assertSee($review->message)
            ->click('svg[id="oStar5"]')
            ->press(__('global.edit_review'))
            ->assertSee(__('global.review_updated'));
    });
});

it('can delete an existing review', function () {
    $user = User::factory()->create();
    $reviewer = User::factory()->create();
    $review = Review::factory()->create(['user_id' => $user->id, 'reviewer_id' => $reviewer->id]);
    
    $this->browse(function (Browser $browser) use ($user, $reviewer, $review) {
        $browser->loginAs($reviewer->id)
            ->visitRoute('user.show', $user->id)
            ->clickLink(__('global.delete_review'))
            ->assertSee(__('global.review_destroyed'))
            ->assertDontSee($review->message);
    });
});

it('doesnt let users write reviews for themselves', function () {
    $user = User::factory()->create();
    
    $this->browse(function (Browser $browser) use ($user) {
        $browser->loginAs($user->id)
            ->visitRoute('user.show', $user->id)
            ->assertDontSee(__('global.write_review'));
    });
});

it('doesnt let users write reviews for their own ads', function () {
    $ad = Ad::factory()->create(['type' => AdTypesEnum::RENTAL]);
    $this->browse(function (Browser $browser) use ($ad) {
        $browser->loginAs($ad->user_id)
            ->visitRoute('ad.show', $ad->id)
            ->assertDontSee(__('global.write_review'));
    });
});
