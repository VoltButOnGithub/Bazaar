<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('can log a user in', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $browser
            ->visit('/')
            ->clickLink(__('global.login'))
            ->type('username', $user->username)
            ->type('password', 'password')
            ->press(__('global.login'))

            ->assertSee(__('global.logged_in'))
            ->assertSee(__('global.logout'))
            ->assertPathIs('/');
    });
});

it('can log a user out', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->create();
        $browser->loginAs($user->id)
            ->visit('/')
            ->clickLink(__('global.logout'))

            ->assertSee(__('global.login'))
            ->assertSee(__('global.logged_out'))
            ->assertPathIs('/');
    });
});
