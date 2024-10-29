<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

//rotas para exibir os detalhes de um grupo
Route::get('/groups/{group:uuid}', [\App\Http\Controllers\GroupController::class, 'show'])->name('groups.show');

Route::get('/participant/{participant:uuid}', [\App\Http\Controllers\ParticipantController::class, 'show'])->name('participant.show');

Route::post('/participants/{participant}/check_password', [\App\Http\Controllers\ParticipantController::class, 'checkPassword'])->name('participants.check_password');
Route::post('/participants/{participant}/set_password', [\App\Http\Controllers\ParticipantController::class, 'setPassword'])->name('participants.set_password');
Route::post('/participants/{participant}/store_suggestion', [\App\Http\Controllers\ParticipantController::class, 'storeSuggestion'])->name('participants.store_suggestion');


//rotas protegidas por autenticação
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
