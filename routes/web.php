<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ideas')->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);

});

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');
    Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas');
    Route::get('/ideas/{id}', [IdeaController::class, 'show'])->name('idea.show');
});
