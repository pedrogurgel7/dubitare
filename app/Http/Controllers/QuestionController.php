<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\{RedirectResponse, Request, Response};

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {

        Question::query()->create(
            request()->validate([
                'question' => ['required',
                    'min:10',
                    function (string $attribute, mixed $value, \Closure $fail) {
                        if ($value[-1] !== '?') {
                            $fail("Are you sure that is a question? It is missing the question mark in the end.");
                        }
                    },
                ],

            ])
        );

        return to_route('dashboard');
    }
}
