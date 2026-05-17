<?php

declare(strict_types=1);

it('registers a new user', function (): void {
    visit(route('register'))
        ->fill('name', 'Hamid')
        ->fill('email', 'hamid@gmail.com')
        ->fill('password', '123456789')
        ->fill('password_confirmation', '123456789')
        ->click('@register-button')
        ->assertPathIs('/')
        ->assertSee('Log out');
});
