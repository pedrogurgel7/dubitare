<?php
use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post, put};

it('should be able to like a question', function () {

    //Arange
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    //Acting

    actingAs($user);

    post(route('question.like', $question))->assertRedirect();

    //Assert

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like'        => 1,
        'unlike'      => 0,
        'user_id'     => $user->id,
    ]);

});
