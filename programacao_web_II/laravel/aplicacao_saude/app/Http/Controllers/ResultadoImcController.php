<?php

namespace App\Http\Controllers;

use App\Models\calcularImc;
use Illuminate\Http\Request;

class ResultadoImcController extends Controller
{
    public function store()
    {
        $imc = new calcularImc();
        $idade = new calcularImc();
        $data['nome'] = request('nome');
        $data['peso'] = request('peso');
        $data['altura'] = request('altura');
        $data['idade'] = $idade->calcularIdade(request('data_nascimento'));    
        $data['imc'] = $imc->getCalcularImc(request('peso'), request('altura'));
        $data['classificacao']=$imc->getClassificacao($data['imc']);
        return view('resultado_imc', $data);
    }
}
