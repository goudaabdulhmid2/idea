<?php

Use App\Models\User;
Use App\Models\Idea;

it('create a new idea', function(){

    $this->actingAs(User::factory()->create());

    visit('/ideas')
    ->click("@create-idea-button")
    ->fill( 'title','My First Idea')
    ->fill('description', 'This is the description of my first idea.')
    ->click('@status-pending-button')
    ->click('@create-idea-submit-button')
    ->assertPathIs('/ideas');

    expect()
    ->toHaveCount(1, Idea::all())
    ->and(Idea::first()->title)->toBe('My First Idea');
});
