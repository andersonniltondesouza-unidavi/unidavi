<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\calcularConsumo;

class ResultadoCombustivelController extends Controller
{
    public function retornarCombustivel() {
        return view('combustivel');
    }

    public function store() {
        $consumo = new calcularConsumo();
        $data['distancia']= request('distancia');
        $data['valor']= request('valor');
        $data['consumo_litro']= request('consumo_litro');
        $data['combustivel']= request('combustivel'); 
        $data['consumo']= $consumo->calcularConsumo($data['distancia'], $data['valor'], $data['consumo_litro']);  
        return view('resultado_combustivel', $data);
    }
}
