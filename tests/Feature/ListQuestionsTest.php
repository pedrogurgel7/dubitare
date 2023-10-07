<?php
use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('Should list all questions in dashboard', function () {
    //Arrange
    $user      = User::factory()->create();
    $questions = Question::factory()->count(5)->create();
    //Acting
    actingAs($user);
    $response = get(route('dashboard'));

    //Assert
    /** @var Question $q */
    foreach ($questions as $q) {
        $response->assertSee($q->question);
    }

});
