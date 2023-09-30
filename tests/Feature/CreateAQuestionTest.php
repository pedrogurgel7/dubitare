<?php
use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new question bigger than 255 characters', function () {
    //Arange
    $user = User::factory()->create();
    actingAs($user);
    //Act
    $request = post(route("question.store"), [
        'question' => str_repeat('*', 260) . "?",
    ]);
    //Assert
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . "?"]);

});

it('Should test if it ends with question mark', function () {

});

it('Should have at least 10 characters', function () {
    //Arange
    $user = User::factory()->create();
    actingAs($user);
    //Act
    $request = post(route("question.store"), [
        'question' => str_repeat('*', 8) . "?",
    ]);

    //Assert
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);

});
