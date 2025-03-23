<?php

namespace App\Http\Controllers;

use App\Models\avaliarSono;
use Illuminate\Http\Request;

class ResultadoSonoController extends Controller
{
    public function store()
    {
        $idade= new avaliarSono();
        $classificacao = new avaliarSono();
        $qualidadeSono = new avaliarSono();
        $data['nome'] = request('nome');
        $data['horas'] = request('horas');
        $data['idade'] = $idade->calcularIdade(request('data_nascimento'));
        $data['classificacao'] = $classificacao->getClassificacao($idade);
        $data['qualidadeSono'] = $qualidadeSono->getQualidadeSono($classificacao, request('horas'));
        return view('resultado_sono' , $data);   
    }
}
