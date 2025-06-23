<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Type\Time;
use App\Http\Controllers\TimesController;
use App\Http\Controllers\JogadoresController;


Route::get('/', function () {
    return view('auth/register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/times/search', [TimesController::class, 'search'])->name('times.search')->middleware(['auth', 'verified']);
Route::get('/jogadores/search', [JogadoresController::class, 'search'])->name('jogadores.search')->middleware(['auth', 'verified']);

Route::resource('times', TimesController::class)->parameters(['jogadores' => 'jogador'])->middleware 
(['auth', 'verified']);
Route::resource('jogadores', JogadoresController::class)->middleware
(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
