<?php


it('registers a new user', function () {
    visit(route('register'))
        ->fill('name', 'Hamid')
        ->fill('email', 'hamid@gmail.com')
        ->fill('password', '123456789')
        ->fill('password_confirmation', '123456789')
        ->click('@register-button')
        ->assertPathIs('/')
        ->assertSee('Log out');
});