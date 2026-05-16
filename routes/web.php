<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionsController;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Route;

Route::get('/', fn (): Factory|\Illuminate\Contracts\View\View => view('welcome'))->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');
});
