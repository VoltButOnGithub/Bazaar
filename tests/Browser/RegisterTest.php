<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('can register a user', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->make();

        $browser
            ->visit('/')
            ->clickLink(__('global.login'))
            ->clickLink('Start here')
            ->click('label[for="type0"]')
            ->type('name', $user->name)
            ->type('username', $user->username)
            ->type('password', 'password')
            ->press('Register')

            ->assertSee(__('global.registered'))
            ->assertSee(__('global.logout'))
            ->assertPathIs('/');
    });
});
