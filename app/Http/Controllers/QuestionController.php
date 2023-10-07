<?php

namespace App\Http\Controllers;

use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\{RedirectResponse, Request, Response};

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {

        request()->validate([
            'created_by' => 'required',
            'question'   => ['required',
                'min:10',
                new EndWithQuestionMarkRule(),
            ],

        ]);

        auth()->user()->questions()->create([
            'question' => request()->question,
            'draft'    => true,
        ]);

        return to_route('dashboard');
    }
}
