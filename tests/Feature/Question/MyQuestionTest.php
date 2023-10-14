<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, get, post, put};

it('should be able to show all my questions', function () {

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $questions1 = Question::factory()->count(5)->create(['created_by' => $user1->id]);
    $questions2 = Question::factory()->count(5)->create(['created_by' => $user2->id]);

    actingAs($user1);

    $response = get(route('question.index'));

    foreach ($questions1 as $q1) {
        $response->assertSee($q1->question);
    }

    foreach ($questions2 as $q2) {
        $response->assertDontSee($q2->question);
    }

});
