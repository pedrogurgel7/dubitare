<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\{ProfileController, Question, QuestionController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(app()->isLocal()) {
        Auth()->loginUsingId(1);

        return to_route('dashboard');
    }

    return view('welcome');

});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
    Route::get('/question/index', [QuestionController::class, 'index'])->name('question.index');

    Route::post('/question/like/{question}', Question\LikeController::class)->name('question.like');
    Route::post('/question/unlike/{question}', Question\UnlikeController::class)->name('question.unlike');
    Route::put('/question/publish/{question}', Question\PublishController::class)->name('question.publish');

});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
