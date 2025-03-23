<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultadoImcController;
use App\Http\Controllers\ResultadoSonoController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('sono');
});

Route::resource('/resultado_sono', ResultadoSonoController::class);
Route::resource('/resultado_imc', ResultadoImcController::class);
