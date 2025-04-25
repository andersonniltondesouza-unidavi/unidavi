<?php

use App\Http\Controllers\ContatosController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TipoContatoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contatos/search', [ContatosController::class, 'search'])->name('contatos.search')->middleware(['auth', 'verified']);

Route::resource('contatos',ContatosController::class)->middleware(['auth', 'verified']);

Route::resource('tipoContatos',TipoContatoController::class)->middleware(['auth', 'verified']);

Route::get('/about', function () {
    return view('about');
})->middleware(['auth', 'verified'])->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
