<?php

namespace App\Http\Controllers;

use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\{RedirectResponse, Request, Response};

class QuestionController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('question.index', [
            'questions' => auth()->user()->questions,
        ]);
    }
    public function store(): RedirectResponse
    {

        request()->validate([

            'question' => ['required',
                'min:10',
                new EndWithQuestionMarkRule(),
            ],

        ]);

        auth()->user()->questions()->create([
            'question' => request()->question,
            'draft'    => true,
        ]);

        return back();
    }
}
