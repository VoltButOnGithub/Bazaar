<?php

use App\Models\User;
use Laravel\Dusk\Browser;

it('can navigated to', function () {
    $this->browse(function (Browser $browser) {
        $browser
            ->visit('/')
            ->clickLink(__('global.login'))
            ->clickLink(__('global.start_here'))
            ->assertTitle(__('global.register'));
    });
});

it('can register an individual user', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->make();

        $browser
            ->visit('/user/create')
            ->click('label[for="type0"]')
            ->type('name', $user->name)
            ->type('username', $user->username)
            ->type('password', 'password')
            ->press(__('global.register'))

            ->assertSee(__('global.registered'))
            ->assertSee(__('global.logout'))
            ->assertPathIs('/');
    });
});

it('can register business', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->make();

        $browser
            ->visit('/user/create')
            ->click('label[for="type2"]')
            ->type('name', $user->name)
            ->type('username', $user->username)
            ->type('password', 'password')
            ->press(__('global.register'))

            ->assertSee(__('global.registered'))
            ->assertSee(__('global.logout'))
            ->assertPathIs('/');
    });
});

it('cant register with missing data', function () {
    $this->browse(function (Browser $browser) {
        $user = User::factory()->make();

        $browser
            ->visit('/user/create')
            ->press(__('global.register'))
            ->assertSee(__('global.register'));
    });
});

it('cant register with malformed data', function () {
    $this->browse(function (Browser $browser) {
        $browser
            ->visit('/user/create')
            ->type('name', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA')
            ->type('username', 'A')
            ->type('password', 'A')
            ->press(__('global.register'))

            ->assertSee(__('global.error_try_again'))
            ->assertSee(__('validation.required', ['attribute' => 'type']))
            ->assertSee(__('validation.max.string', ['attribute' => 'name', 'max' => 25]))
            ->assertSee(__('validation.min.string', ['attribute' => 'username', 'min' => 3]))
            ->assertSee(__('validation.min.string', ['attribute' => 'password', 'min' => 3]));
    });
});
