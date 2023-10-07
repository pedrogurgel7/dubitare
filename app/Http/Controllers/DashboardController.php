<?php

namespace App\Http\Controllers;

use App\Models\Question;

class DashboardController extends Controller
{
    /**
     * Summary of __invoke
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke()
    {

        $questions = Question::all();

        return view('dashboard', [
            'questions' => $questions,
        ]);
    }
}
