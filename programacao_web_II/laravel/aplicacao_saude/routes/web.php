<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultadoController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('imc');
});

Route::resource('/resultado', ResultadoController::class);
