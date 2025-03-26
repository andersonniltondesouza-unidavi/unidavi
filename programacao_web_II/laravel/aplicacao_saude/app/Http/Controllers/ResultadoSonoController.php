<?php

namespace App\Http\Controllers;

use App\Models\avaliarSono;
use Illuminate\Http\Request;

class ResultadoSonoController extends Controller
{
    public function retornarSono() {
        return view('sono');
    }

    public function store()
    {
        $idade = new avaliarSono();
        $data['nome'] = request('nome');
        $data['horas'] = request('horas');
        $data['idade'] = $idade-> mostrarIdade(request('data_nascimento'));
        $data['classificacao'] = $idade->getClassificacao($idade->calcularIdade(request('data_nascimento')));
        $data['qualidadeSono'] = $idade->getQualidadeSono($data['classificacao'], request('horas'));
        return view('resultado_sono' , $data);   
    }
}
