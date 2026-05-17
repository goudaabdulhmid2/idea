<?php

use App\Models\User;

it('log in a user', function (): void {
    $user = User::factory()->create([
        'email' => 'hamid@gmail.com',
        'password' => bcrypt('123456789'),
    ]);

    visit(route('login'))
        ->fill('email', $user->email)
        ->fill('password', '123456789')
        ->click('@login-button')
        ->assertPathIs(route('home'))
        ->assertSee('Log out');
});
