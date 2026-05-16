<?php

use App\Models\Idea;
use App\Models\User;

test('it belongs to a user', function (): void {
    $idea = Idea::factory()->create();

    expect($idea->user)->toBeInstanceOf(User::class);
});

test('it has many steps', function (): void {
    $idea = Idea::factory()->create();

    expect($idea->steps)->not->toBeNull();

    $idea->steps()->create([
        'description' => 'Step 1',
        'is_completed' => false,
    ]);

    expect($idea->fresh()->steps)->toHaveCount(1);
});
