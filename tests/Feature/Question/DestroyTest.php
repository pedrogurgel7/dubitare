<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, assertDatabaseMissing, delete, post, put};

it('should be able to delete questions', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create(['draft' => true, 'created_by' => $user->id]);

    actingAs($user);

    delete(route('question.destroy', $question))->assertRedirect();

    assertDatabaseMissing('questions', ['id' => $question->id]);

});

it('should make sure that only who creates the question can destroy', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();

    $question = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    actingAs($wrongUser);
    delete(route('question.destroy', $question))->assertForbidden();

    actingAs($rightUser);
    delete(route('question.destroy', $question))->assertRedirect();

});
