<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\{RedirectResponse, Request, Response};

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {

        Question::query()->create(
            request()->validate([
                'question' => ['required',
                    'min:10',
                    new EndWithQuestionMarkRule(),
                ],

            ])
        );

        return to_route('dashboard');
    }
}
