<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\SobreController;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
    return view('home');
});

Route::resource('/contato', ContatoController::class);

Route::get('/sobre',[SobreController::class,'sobre']);
