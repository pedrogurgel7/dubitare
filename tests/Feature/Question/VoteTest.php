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

it('should not be able to like a question twice', function () {

    //Arange
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    //Acting

    actingAs($user);

    post(route('question.like', $question))->assertRedirect();
    post(route('question.like', $question))->assertRedirect();
    post(route('question.like', $question))->assertRedirect();
    post(route('question.like', $question))->assertRedirect();

    //Assert

    expect($user->votes()->get())->toHaveCount(1);
});

it('should be able to dislike a question', function () {

    //Arange
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    //Acting

    actingAs($user);

    post(route('question.unlike', $question))->assertRedirect();

    //Assert

    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like'        => 0,
        'unlike'      => 1,
        'user_id'     => $user->id,
    ]);

});

it('should not be able to unlike a question twice', function () {

    //Arange
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    //Acting

    actingAs($user);

    post(route('question.unlike', $question))->assertRedirect();
    post(route('question.unlike', $question))->assertRedirect();
    post(route('question.unlike', $question))->assertRedirect();
    post(route('question.unlike', $question))->assertRedirect();

    //Assert

    expect($user->votes()->get())->toHaveCount(1);
});
