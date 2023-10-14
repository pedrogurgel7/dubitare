<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post, put};

it('should be able to update status of questions to draft = false', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create(['draft' => true, 'created_by' => $user->id]);

    actingAs($user);

    put(route('question.publish', $question))->assertRedirect();

    $question->refresh();

    expect($question->draft)->toBeFalse();

});

it('should make sure that only who creates the question can publish', function () {
    $rightUser = User::factory()->create();
    $wrongUser = User::factory()->create();

    $question = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    actingAs($wrongUser);
    put(route('question.publish', $question))->assertForbidden();

    actingAs($rightUser);
    put(route('question.publish', $question))->assertRedirect();

    $question->refresh();

    expect($question->draft)->toBeFalse();

});
