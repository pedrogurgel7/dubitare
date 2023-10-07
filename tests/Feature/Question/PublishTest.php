<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post, put};

it('should be able to update status of questions to draft = false', function () {
    $question = Question::factory()->create(['draft' => true]);
    $user     = User::factory()->create();

    actingAs($user);

    put(route('question.publish', $question))->assertRedirect();

    $question->refresh();

    expect($question->draft)->toBeFalse();

});
