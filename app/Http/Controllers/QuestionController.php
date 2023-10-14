<?php

namespace App\Http\Controllers;

use App\Rules\EndWithQuestionMarkRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\{Request, Response};

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

    /**
     * Summary of destroy
     * @param \App\Models\Question $question
     * @return RedirectResponse;

     */
    public function destroy(\App\Models\Question $question): RedirectResponse
    {
        abort_unless(auth()->user()->can('destroy', $question), \Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);

        $question->delete();

        return back();
    }
}
