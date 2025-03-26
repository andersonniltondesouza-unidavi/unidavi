<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultadoImcController;
use App\Http\Controllers\ResultadoSonoController;
use App\Http\Controllers\ResultadoCombustivelController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('/imc', [ResultadoImcController::class, 'retornarImc']);
Route::resource('/resultado_imc', ResultadoImcController::class);

Route::get('/sono', [ResultadoSonoController::class, 'retornarSono']);
Route::resource('/resultado_sono', ResultadoSonoController::class);

Route::get('/combustivel', [ResultadoCombustivelController::class, 'retornarCombustivel']);
Route::resource('/resultado_combustivel', ResultadoCombustivelController::class);
