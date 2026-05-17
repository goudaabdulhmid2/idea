<?php

use App\Models\User;

it('log out a user', function (): void {
    $user = User::factory()->create();

    $this->actingAs($user);

    visit('/')
        ->click('Log out')
        ->assertSee('Log in');
});
