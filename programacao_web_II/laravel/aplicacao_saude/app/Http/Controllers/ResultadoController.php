<?php

namespace App\Http\Controllers;

use App\Models\calcular;
use Illuminate\Http\Request;

class ResultadoController extends Controller
{
    public function store()
    {
        $imc = new calcular();
        $data['imc'] = $imc->getCalcular(request('peso'), request('altura'));
        $data['classificacao']=$imc->getClassificacao($data['imc']);
        return view('resultado', $data);
    }
}